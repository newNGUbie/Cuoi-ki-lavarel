<?php

namespace App\Http\Controllers;

use App\Mail\OrderPlacedMail;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Customer;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\ShippingFee;
use App\Models\Slide;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function getIndex()
    {
        $slides = Slide::all();
        $new_products = Product::where('new', true)->paginate(8);
        $top_products = Product::where('stock', '>', 0)
            ->orderByDesc('promotion_price')
            ->orderByDesc('id')
            ->paginate(8);
        $promotion_products = Product::where('promotion_price', '>', 0)->paginate(4);
        $all_products = Product::orderByDesc('id')->paginate(12);

        return view('pages.trangchu', compact(
            'slides',
            'new_products',
            'top_products',
            'promotion_products',
            'all_products'
        ));
    }

    public function getChiTiet($sanpham_id)
    {
        $sanpham = Product::find($sanpham_id);
        if (! $sanpham) {
            return redirect()->route('banhang.index')->with('error', 'Không tìm thấy sản phẩm');
        }

        return view('pages.chitiet_sanpham', compact('sanpham'));
    }

    public function getLoaiSp($type)
    {
        $sp_theoloai = Product::where('id_type', $type)->get();
        $loai = ProductType::all();
        $loai_sp = ProductType::where('id', $type)->first();

        return view('pages.loai_sanpham', compact('sp_theoloai', 'loai', 'loai_sp'));
    }

    public function addToCart(Request $request, $id)
    {
        $product = Product::find($id);
        if (! $product) {
            return redirect()->back()->with('error', 'Sản phẩm không tồn tại');
        }
        $oldCart = Session('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $id);
        $request->session()->put('cart', $cart);

        return redirect()->back();
    }

    public function delCartItem($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        if (! $cart->items || ! array_key_exists($id, $cart->items)) {
            return redirect()->back();
        }
        $cart->removeItem($id);
        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }

        return redirect()->back();
    }

    public function getGioHang()
    {
        if (! Session::has('cart')) {
            return view('pages.giohang');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        return view('pages.giohang', [
            'productCarts' => $cart->items,
            'totalPrice' => $cart->totalPrice,
            'totalQty' => $cart->totalQty,
        ]);
    }

    public function getCheckout()
    {
        if (! Session::has('cart')) {
            return redirect()->route('banhang.giohang')->with('error', 'Giỏ hàng đang trống.');
        }

        $cart = new Cart(Session::get('cart'));
        $subtotal = $cart->totalPrice;
        $shippingFees = ShippingFee::where('is_active', true)->orderBy('id')->get();
        $appliedCoupon = $this->sessionCoupon();

        $selectedShippingId = (int) old('shipping_fee_id', $shippingFees->first()?->id);
        $shippingRule = $shippingFees->firstWhere('id', $selectedShippingId);
        $shippingAmount = $shippingRule ? $this->computeShippingFee($shippingRule, $subtotal) : 0;
        $discountAmount = $appliedCoupon ? $this->computeCouponDiscount($appliedCoupon, $subtotal) : 0;
        $grandTotal = max(0, $subtotal - $discountAmount + $shippingAmount);

        return view('checkout', compact(
            'cart',
            'subtotal',
            'shippingFees',
            'shippingAmount',
            'discountAmount',
            'grandTotal',
            'appliedCoupon',
            'selectedShippingId'
        ));
    }

    public function postApplyCoupon(Request $request)
    {
        if (! Session::has('cart')) {
            return redirect()->route('banhang.giohang')->with('error', 'Giỏ hàng đang trống.');
        }

        $request->validate(['code' => 'required|string|max:50'], [
            'code.required' => 'Vui lòng nhập mã giảm giá',
        ]);

        $cart = new Cart(Session::get('cart'));
        $subtotal = $cart->totalPrice;

        $coupon = Coupon::whereRaw('UPPER(code) = ?', [Str::upper(trim($request->code))])->first();
        if (! $coupon || ! $coupon->is_active) {
            return redirect()->back()->with('error', 'Mã giảm giá không hợp lệ.');
        }
        if ($coupon->starts_at && now()->lt($coupon->starts_at)) {
            return redirect()->back()->with('error', 'Mã giảm giá chưa có hiệu lực.');
        }
        if ($coupon->ends_at && now()->gt($coupon->ends_at)) {
            return redirect()->back()->with('error', 'Mã giảm giá đã hết hạn.');
        }
        if ($coupon->max_uses !== null && $coupon->used_count >= $coupon->max_uses) {
            return redirect()->back()->with('error', 'Mã giảm giá đã hết lượt sử dụng.');
        }
        if ($subtotal < (float) $coupon->min_order_total) {
            return redirect()->back()->with('error', 'Đơn hàng chưa đạt giá trị tối thiểu để áp dụng mã.');
        }

        Session::put('checkout_coupon_code', $coupon->code);

        return redirect()->route('banhang.getdathang')->with('success', 'Đã áp dụng mã giảm giá.');
    }

    public function postRemoveCoupon()
    {
        Session::forget('checkout_coupon_code');

        return redirect()->route('banhang.getdathang')->with('success', 'Đã bỏ mã giảm giá.');
    }

    public function postCheckout(Request $request)
    {
        if (! Session::has('cart')) {
            return redirect()->route('banhang.giohang')->with('error', 'Giỏ hàng đang trống.');
        }

        $request->validate(
            [
                'name' => 'required|string|max:150',
                'gender' => 'required|string|max:20',
                'email' => 'required|email|max:190',
                'address' => 'required|string|max:255',
                'phone_number' => 'required|string|max:30',
                'payment_method' => 'required|in:COD,ATM,VNPAY',
                'shipping_fee_id' => 'required|exists:shipping_fees,id',
                'notes' => 'nullable|string|max:500',
            ],
            [
                'name.required' => 'Vui lòng nhập họ tên',
                'email.required' => 'Vui lòng nhập email',
                'address.required' => 'Vui lòng nhập địa chỉ',
                'phone_number.required' => 'Vui lòng nhập số điện thoại',
                'payment_method.required' => 'Vui lòng chọn hình thức thanh toán',
                'shipping_fee_id.required' => 'Vui lòng chọn khu vực giao hàng',
            ]
        );

        $cart = new Cart(Session::get('cart'));
        $subtotal = $cart->totalPrice;

        $shippingRule = ShippingFee::where('is_active', true)->where('id', $request->shipping_fee_id)->first();
        if (! $shippingRule) {
            return redirect()->back()->withInput()->with('error', 'Phương án vận chuyển không hợp lệ.');
        }

        $shippingFee = $this->computeShippingFee($shippingRule, $subtotal);
        $coupon = $this->sessionCoupon();
        $discountAmount = $coupon ? $this->computeCouponDiscount($coupon, $subtotal) : 0;
        if ($coupon && $subtotal < (float) $coupon->min_order_total) {
            Session::forget('checkout_coupon_code');
            $coupon = null;
            $discountAmount = 0;
        }

        $total = max(0, $subtotal - $discountAmount + $shippingFee);

        $bill = DB::transaction(function () use ($request, $cart, $subtotal, $shippingFee, $discountAmount, $total, $coupon) {
            $customer = new Customer;
            $customer->name = $request->name;
            $customer->gender = $request->gender;
            $customer->email = $request->email;
            $customer->address = $request->address;
            $customer->phone_number = $request->phone_number;
            $customer->note = $request->notes;
            $customer->save();

            $bill = new Bill;
            $bill->id_customer = $customer->id;
            $bill->user_id = Auth::id();
            $bill->date_order = date('Y-m-d');
            $bill->subtotal = $subtotal;
            $bill->shipping_fee = $shippingFee;
            $bill->coupon_code = $coupon?->code;
            $bill->discount_amount = $discountAmount;
            $bill->total = $total;
            $bill->payment = $request->payment_method;
            $bill->note = $request->notes;
            $bill->status = 'Mới';
            $bill->save();

            foreach ($cart->items as $key => $value) {
                $bill_detail = new BillDetail;
                $bill_detail->id_bill = $bill->id;
                $bill_detail->id_product = $key;
                $bill_detail->quantity = $value['qty'];
                $bill_detail->unit_price = $value['price'] / $value['qty'];
                $bill_detail->save();
            }

            if ($coupon) {
                $coupon->increment('used_count');
            }

            return $bill->fresh(['customer', 'bill_detail.product']);
        });

        Session::forget('cart');
        Session::forget('checkout_coupon_code');

        try {
            Mail::to($bill->customer->email)->send(new OrderPlacedMail($bill));
        } catch (\Throwable $e) {
            Log::error('Lỗi gửi email xác nhận đơn hàng: ' . $e->getMessage());
        }

        return redirect()->route('banhang.index')->with('success', 'Đặt hàng thành công. Vui lòng kiểm tra email xác nhận đơn hàng.');
    }

    public function getSignin()
    {
        return view('dangky');
    }

    public function postSignin(Request $req)
    {
        $req->validate(
            [
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|max:20',
                'fullname' => 'required',
                'repassword' => 'required|same:password',
            ],
            [
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Không đúng định dạng email',
                'email.unique' => 'Email đã có người sử dụng',
                'password.required' => 'Vui lòng nhập mật khẩu',
                'repassword.same' => 'Mật khẩu không giống nhau',
                'password.min' => 'Mật khẩu ít nhất 6 ký tự',
            ]
        );

        $user = User::create([
            'full_name' => $req->fullname,
            'email' => $req->email,
            'password' => Hash::make($req->password),
            'phone' => $req->phone,
            'address' => $req->address,
            'level' => 3,
        ]);

        return redirect()->route('getlogin')->with('success', 'Tạo tài khoản thành công. Vui lòng đăng nhập.');
    }

    public function getLogin()
    {
        return view('login');
    }

    public function postLogin(Request $req)
    {
        $req->validate(
            [
                'email' => 'required|email',
                'password' => 'required|min:6|max:20',
            ],
            [
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Không đúng định dạng email',
                'password.required' => 'Vui lòng nhập mật khẩu',
                'password.min' => 'Mật khẩu ít nhất 6 ký tự',
            ]
        );
        $credentials = ['email' => $req->email, 'password' => $req->password];
        $remember = $req->boolean('remember');
        if (Auth::attempt($credentials, $remember)) {
            $req->session()->regenerate();

            return redirect()->intended('/trangchu')->with(['flag' => 'success', 'message' => 'Đăng nhập thành công']);
        }

        return redirect()->back()->withInput($req->only('email'))->with(['flag' => 'danger', 'message' => 'Email hoặc mật khẩu không đúng']);
    }

    public function getLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('banhang.index');
    }

    public function getSearch(Request $req)
    {
        $key = trim((string) $req->input('key', ''));
        if ($key === '') {
            $product = collect();
        } else {
            $product = Product::query()
                ->where(function ($q) use ($key) {
                    $q->where('name', 'like', '%' . $key . '%');
                    if (is_numeric($key)) {
                        $q->orWhere('unit_price', (float) $key);
                    }
                })
                ->get();
        }

        return view('pages.search', compact('product'));
    }

    public function getUpdateCart(Request $req, $id)
    {
        if (! Session::has('cart')) {
            return redirect()->back();
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        if (! $cart->items || ! array_key_exists($id, $cart->items)) {
            return redirect()->back();
        }
        $cart->updateQty($id, (int) $req->qty);
        Session::put('cart', $cart);

        return redirect()->back();
    }

    public function getInputEmail()
    {
        return view('emails.input-email');
    }

    public function postInputEmail(Request $req)
    {
        $email = $req->txtEmail;
        $user = User::where('email', $email)->get();
        if ($user->count() != 0) {
            $sentData = [
                'title' => 'Mật khẩu mới của bạn là:',
                'body' => '123456',
            ];
            Mail::to($email)->send(new \App\Mail\SendMail($sentData));
            Session::flash('message', 'Send email successfully!');

            return view('login');
        }

        return redirect()->route('getInputEmail')->with('message', 'Your email is not right');
    }

    public function getProfile()
    {
        if (! Auth::check()) {
            return redirect()->route('getlogin')->with('message', 'Vui lòng đăng nhập để xem hồ sơ');
        }
        $user = Auth::user();
        $orders = Bill::with(['customer', 'bill_detail.product'])
            ->where(function ($q) use ($user) {
                $q->where('user_id', $user->id)
                    ->orWhereHas('customer', function ($c) use ($user) {
                        $c->where('email', $user->email);
                    });
            })
            ->orderByDesc('created_at')
            ->get();

        return view('pages.profile', compact('user', 'orders'));
    }

    public function postProfile(Request $req)
    {
        if (! Auth::check()) {
            return redirect()->route('getlogin')->with('message', 'Vui lòng đăng nhập');
        }

        $req->validate([
            'full_name' => 'required|string|max:150',
            'phone' => 'nullable|string|max:30',
            'address' => 'nullable|string|max:255',
        ], [
            'full_name.required' => 'Vui lòng nhập họ tên',
        ]);

        $user = User::find(Auth::id());
        $user->full_name = $req->full_name;
        $user->phone = $req->phone;
        $user->address = $req->address;
        $user->save();

        return redirect()->route('user.profile')->with('success', 'Cập nhật hồ sơ thành công');
    }

    private function sessionCoupon(): ?Coupon
    {
        $code = Session::get('checkout_coupon_code');
        if (! $code) {
            return null;
        }

        return Coupon::whereRaw('UPPER(code) = ?', [Str::upper($code)])->first();
    }

    private function computeShippingFee(ShippingFee $rule, float $subtotal): float
    {
        $fee = (float) $rule->fee;
        if ($rule->free_shipping_min_total !== null && $subtotal >= (float) $rule->free_shipping_min_total) {
            return 0;
        }

        return $fee;
    }

    private function computeCouponDiscount(Coupon $coupon, float $subtotal): float
    {
        if ($coupon->type === 'percent') {
            $d = round($subtotal * ((float) $coupon->value / 100));

            return min($subtotal, $d);
        }

        return min($subtotal, (float) $coupon->value);
    }
}
