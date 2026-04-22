<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminUserController extends Controller
{
    public function getList(){
        $user = User::all();
        return view('admin.user.list', compact('user'));
    }

    public function getDelete($id){
        $user = User::find($id);
        $user->delete();
        return redirect()->route('admin.user.list')->with('success', 'Xoa thanh cong');
    }
}
