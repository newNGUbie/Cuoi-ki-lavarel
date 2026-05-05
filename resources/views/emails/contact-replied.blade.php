<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Phản hồi liên hệ</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.5;">
    <h2>Xin chào {{ $contact->name }},</h2>
    <p>Chúng tôi đã nhận được lời nhắn của bạn và gửi phản hồi như sau:</p>
    <blockquote style="border-left: 4px solid #0277b8; padding-left: 12px; margin: 16px 0;">
        {!! nl2br(e($replyMessage)) !!}
    </blockquote>
    <p><strong>Trạng thái xử lý:</strong> {{ $status }}</p>
    <p>Trân trọng,<br>{{ config('app.name') }}</p>
</body>
</html>
