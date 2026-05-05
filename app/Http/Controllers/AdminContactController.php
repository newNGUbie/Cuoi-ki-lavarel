<?php

namespace App\Http\Controllers;

use App\Mail\ContactRepliedMail;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->get();

        return view('admin.contact.list', compact('contacts'));
    }

    public function postUpdateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Chưa liên hệ,Đã liên hệ,Đang xử lý',
            'reply_message' => 'nullable|string|max:2000',
        ]);

        $contact = Contact::find($id);
        if (! $contact) {
            return redirect()->back()->with('error', 'Không tìm thấy liên hệ!');
        }

        $reply = trim((string) $request->reply_message);
        $contact->status = $request->status;
        $contact->reply_message = $reply !== '' ? $reply : $contact->reply_message;
        $contact->save();

        if ($reply !== '') {
            try {
                Mail::to($contact->email)->send(new ContactRepliedMail($contact, $reply, $contact->status));
            } catch (\Throwable $e) {
                // Mail có thể chưa cấu hình trong môi trường local
            }
        }

        return redirect()->back()->with('success', 'Cập nhật liên hệ thành công!');
    }
}
