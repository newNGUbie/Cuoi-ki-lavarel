<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Đặt hàng thành công</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.5;">
    <h2>Xin chào {{ $bill->customer->name }},</h2>
    <p>Cảm ơn bạn đã đặt hàng tại <strong>{{ config('app.name') }}</strong>. Dưới đây là chi tiết đơn hàng <strong>#{{ $bill->id }}</strong>.</p>

    <table cellpadding="8" cellspacing="0" border="1" style="border-collapse: collapse; width: 100%; max-width: 640px;">
        <thead>
            <tr>
                <th align="left">Sản phẩm</th>
                <th align="right">Đơn giá</th>
                <th align="right">SL</th>
                <th align="right">Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bill->bill_detail as $row)
            <tr>
                <td>{{ $row->product->name ?? 'Sản phẩm' }}</td>
                <td align="right">{{ number_format($row->unit_price) }} đ</td>
                <td align="right">{{ $row->quantity }}</td>
                <td align="right">{{ number_format($row->unit_price * $row->quantity) }} đ</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p><strong>Tạm tính:</strong> {{ number_format($bill->subtotal) }} đ</p>
    <p><strong>Phí vận chuyển:</strong> {{ number_format($bill->shipping_fee) }} đ</p>
    @if($bill->discount_amount > 0)
        <p><strong>Giảm giá ({{ $bill->coupon_code }}):</strong> -{{ number_format($bill->discount_amount) }} đ</p>
    @endif
    <p><strong>Tổng thanh toán:</strong> {{ number_format($bill->total) }} đ</p>
    <p><strong>Hình thức thanh toán:</strong> {{ $bill->payment }}</p>
    <p><strong>Trạng thái:</strong> {{ $bill->status }}</p>

    <p>Chúng tôi sẽ xử lý đơn hàng và cập nhật trạng thái qua email cho bạn.</p>
</body>
</html>
