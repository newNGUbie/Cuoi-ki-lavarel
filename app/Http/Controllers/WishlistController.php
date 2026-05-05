<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        if (! Auth::check()) {
            return redirect()->route('getlogin')->with('message', 'Vui lòng đăng nhập để xem danh sách yêu thích');
        }
        $wishlists = Wishlist::with('product')->where('user_id', Auth::id())->get();

        return view('pages.wishlist', compact('wishlists'));
    }

    public function add($id)
    {
        if (! Auth::check()) {
            return redirect()->route('getlogin')->with('message', 'Vui lòng đăng nhập để lưu sản phẩm yêu thích');
        }

        $exists = Wishlist::where('user_id', Auth::id())->where('product_id', $id)->first();
        if (! $exists) {
            Wishlist::create([
                'user_id' => Auth::id(),
                'product_id' => $id,
            ]);

            return redirect()->back()->with('success', 'Đã thêm vào danh sách yêu thích');
        }

        return redirect()->back()->with('success', 'Sản phẩm đã có trong danh sách yêu thích');
    }

    public function remove($id)
    {
        if (Auth::check()) {
            Wishlist::where('user_id', Auth::id())->where('product_id', $id)->delete();
        }

        return redirect()->back()->with('success', 'Đã xóa khỏi danh sách yêu thích');
    }
}
