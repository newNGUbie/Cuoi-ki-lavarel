<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;
    public $sentData;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sentData)
    {
        $this->sentData = $sentData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //view ở đây là trang chứa các thông tin mình muốn hiển thị
        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->subject('Yêu cầu cấp lại mật khẩu từ cửa hàng Đồ Gia Dụng')
            ->replyTo(config('mail.from.address'), 'Bộ phận chăm sóc khách hàng')
            ->view('emails.interfaceEmail', ['sentData' => $this->sentData]);
    }
}
