<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function getContact()
    {
        return view('pages.contact');
    }

    public function postContact(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'status' => 'Chưa liên hệ',
        ]);

        return redirect()->back()->with('success', 'Gửi lời nhắn thành công. Chúng tôi sẽ liên hệ lại với bạn sớm nhất!');
    }
}
