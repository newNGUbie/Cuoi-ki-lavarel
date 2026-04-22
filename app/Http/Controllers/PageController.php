<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Slide;
use App\Models\Cart;
use App\Models\ProductType;
use App\Models\Customer;
use App\Models\Bill;
use App\Models\BillDetail;
use Illuminate\Support\Facades\Session;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    //hàm trả về trang chủ
    public function getIndex(){
        $slides = Slide::all();

        //lấy về sản phẩm mới hiển thị ra trang chủ
        $new_products = Product::where('new', 1)->paginate(8);

        //lấy về sản phẩm đề nghị hiển thị ra trang chủ
        $top_products = Product::where('new', 0)->paginate(8);

        //lấy về sản phẩm khuyến mãi hiển thị ra trang chủ
        $promotion_products = Product::where('promotion_price', '<>', 0)->paginate(4);
       
        return view('pages.trangchu', compact('slides', 'new_products', 'top_products', 'promotion_products'));
    }

    //hàm trả về chi tiết sản phẩm
    public function getChiTiet($sanpham_id){
        $sanpham = Product::find($sanpham_id);
        return view('pages.chitiet_sanpham', compact('sanpham'));
    }

    //lấy sản phẩm theo loại
    public function getLoaiSp($type){
        $sp_theoloai = Product::where('id_type', $type)->get();
        $loai = ProductType::all();
        $loai_sp = ProductType::where('id', $type)->first();
        return view('pages.loai_sanpham', compact('sp_theoloai', 'loai', 'loai_sp'));
    }

    public function addToCart(Request $request, $id){
        $product = Product::find($id);
        $oldCart = Session('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $id);
        $request->session()->put('cart', $cart);
        return redirect()->back();
    }

    public function delCartItem($id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if(count($cart->items) > 0){
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }
        return redirect()->back();
    }

    public function getGioHang(){
        if(!Session::has('cart')){
            return view('pages.giohang');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('pages.giohang', [
            'productCarts' => $cart->items,
            'totalPrice' => $cart->totalPrice,
            'totalQty' => $cart->totalQty
        ]);
    }

    public function getCheckout(){
        return view('checkout');
    }

    public function postCheckout(Request $request){
        $cart = Session::get('cart');

        $customer = new Customer;
        $customer->name = $request->input('name');
        $customer->gender = $request->input('gender');
        $customer->email = $request->input('email');
        $customer->address = $request->input('address');
        $customer->phone_number = $request->input('phone_number');
        $customer->note = $request->input('notes');
        $customer->save();

        $bill = new Bill;
        $bill->id_customer = $customer->id;
        $bill->date_order = date('Y-m-d');
        $bill->total = $cart->totalPrice;
        $bill->payment = $request->input('payment_method');
        $bill->note = $request->input('notes');
        $bill->save();

        foreach ($cart->items as $key => $value) {
            $bill_detail = new BillDetail;
            $bill_detail->id_bill = $bill->id;
            $bill_detail->id_product = $key;
            $bill_detail->quantity = $value['qty'];
            $bill_detail->unit_price = $value['price']/$value['qty'];
            $bill_detail->save();
        }
        
        Session::forget('cart');
        return redirect()->back()->with('success', 'Đặt hàng thành công');
    }

    public function getSignin(){
        return view('dangky');
    }

    public function postSignin(Request $req){
        $req->validate(
        [
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:6|max:20',
            'fullname'=>'required',
            'repassword'=>'required|same:password'
        ],
        [
            'email.required'=>'Vui lòng nhập email',
            'email.email'=>'Không đúng định dạng email',
            'email.unique'=>'Email đã có người sử dụng',
            'password.required'=>'Vui lòng nhập mật khẩu',
            'repassword.same'=>'Mật khẩu không giống nhau',
            'password.min'=>'Mật khẩu ít nhất 6 ký tự'
        ]);

        $user = new User();
        $user->full_name = $req->fullname;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->phone = $req->phone;
        $user->address = $req->address;
        $user->level = 3; 
        $user->save();
        return redirect()->back()->with('success', 'Tạo tài khoản thành công');
    }

    public function getLogin(){
        return view('login');
    }

    public function postLogin(Request $req){
        $req->validate(
        [
            'email'=>'required|email',
            'password'=>'required|min:6|max:20'
        ],
        [
            'email.required'=>'Vui lòng nhập email',
            'email.email'=>'Không đúng định dạng email',
            'password.required'=>'Vui lòng nhập mật khẩu',
            'password.min'=>'Mật khẩu ít nhất 6 ký tự'
        ]);
        $credentials = ['email'=>$req->email, 'password'=>$req->password];
        if(Auth::attempt($credentials)){
            return redirect('/trangchu')->with(['flag'=>'success','message'=>'Đăng nhập thành công']);
        }
        else{
            return redirect()->back()->with(['flag'=>'danger','message'=>'Đăng nhập không thành công']);
        }
    }

    public function getLogout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('banhang.index');
    }

    public function getSearch(Request $req){
        $product = Product::where('name', 'like', '%'.$req->key.'%')
                            ->orWhere('unit_price', $req->key)
                            ->get();
        return view('pages.search', compact('product'));
    }

    public function getUpdateCart(Request $req, $id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->updateQty($id, $req->qty);
        Session::put('cart', $cart);
        return redirect()->back();
    }
}
