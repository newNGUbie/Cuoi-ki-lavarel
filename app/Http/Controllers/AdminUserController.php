<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserController extends Controller
{
    public function getList(){
        $user = User::all();
        return view('admin.user.list', compact('user'));
    }

    public function getAdd(){
        return view('admin.user.add');
    }

    public function postAdd(Request $request){
        $request->validate(
            [
                'full_name' => 'required|string|max:150',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|max:20|confirmed',
                'phone' => 'nullable|string|max:30',
                'address' => 'nullable|string|max:255',
                'level' => 'required|in:1,2,3',
            ],
            [
                'full_name.required' => 'Vui lòng nhập họ tên',
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Email không đúng định dạng',
                'email.unique' => 'Email đã tồn tại',
                'password.required' => 'Vui lòng nhập mật khẩu',
                'password.min' => 'Mật khẩu ít nhất 6 ký tự',
                'password.confirmed' => 'Xác nhận mật khẩu không khớp',
                'level.required' => 'Vui lòng chọn quyền tài khoản',
            ]
        );

        User::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'level' => $request->level,
        ]);

        return redirect()->route('admin.user.list')->with('success', 'Thêm tài khoản thành công');
    }

    public function getEdit($id){
        $user = User::find($id);
        if (! $user) {
            return redirect()->route('admin.user.list')->with('error', 'Không tìm thấy tài khoản');
        }

        return view('admin.user.edit', compact('user'));
    }

    public function postEdit(Request $request, $id){
        $user = User::find($id);
        if (! $user) {
            return redirect()->route('admin.user.list')->with('error', 'Không tìm thấy tài khoản');
        }

        $request->validate(
            [
                'full_name' => 'required|string|max:150',
                'email' => 'required|email|unique:users,email,'.$user->id,
                'password' => 'nullable|min:6|max:20|confirmed',
                'phone' => 'nullable|string|max:30',
                'address' => 'nullable|string|max:255',
                'level' => 'required|in:1,2,3',
            ],
            [
                'full_name.required' => 'Vui lòng nhập họ tên',
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Email không đúng định dạng',
                'email.unique' => 'Email đã tồn tại',
                'password.min' => 'Mật khẩu ít nhất 6 ký tự',
                'password.confirmed' => 'Xác nhận mật khẩu không khớp',
                'level.required' => 'Vui lòng chọn quyền tài khoản',
            ]
        );

        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->level = $request->level;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('admin.user.list')->with('success', 'Cập nhật tài khoản thành công');
    }

    public function getDelete($id){
        $user = User::find($id);
        if (! $user) {
            return redirect()->route('admin.user.list')->with('error', 'Không tìm thấy tài khoản');
        }
        if (Auth::id() === $user->id) {
            return redirect()->route('admin.user.list')->with('error', 'Không thể xóa tài khoản đang đăng nhập');
        }
        $user->delete();

        return redirect()->route('admin.user.list')->with('success', 'Xóa tài khoản thành công');
    }
}
