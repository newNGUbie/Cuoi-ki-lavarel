<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Cập nhật trạng thái đơn hàng</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.5;">
    <h2>Xin chào {{ $bill->customer->name }},</h2>
    <p>Đơn hàng <strong>#{{ $bill->id }}</strong> của bạn đã được cập nhật trạng thái.</p>
    <p><strong>Trạng thái cũ:</strong> {{ $oldStatus }}</p>
    <p><strong>Trạng thái mới:</strong> {{ $newStatus }}</p>
    <p><strong>Tổng đơn:</strong> {{ number_format($bill->total) }} đ</p>
    <p>Nếu cần hỗ trợ, vui lòng trả lời email này hoặc liên hệ qua trang Liên hệ trên website.</p>
</body>
</html>
