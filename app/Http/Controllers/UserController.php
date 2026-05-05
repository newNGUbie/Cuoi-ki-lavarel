<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getLogin()
    {
        return view('admin.login');
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
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->level == 1 || $user->level == 2) {
                return redirect('/admin/category/danhsach')
                    ->with(['flag' => 'success', 'message' => 'Đăng nhập quản trị thành công']);
            }

            Auth::logout();
            $req->session()->invalidate();
            $req->session()->regenerateToken();

            return redirect()->back()
                ->with(['flag' => 'danger', 'message' => 'Tài khoản này không có quyền truy cập trang quản trị']);
        }

        return redirect()->back()
            ->with(['flag' => 'danger', 'message' => 'Đăng nhập không thành công']);
    }

    public function getLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.getLogin');
    }
}
