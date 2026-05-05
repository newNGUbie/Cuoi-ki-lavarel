@extends('layout.master')
@section('content')
<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">Hồ sơ cá nhân</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb font-large">
                <a href="{{route('banhang.index')}}">Trang chủ</a> / <span>Hồ sơ cá nhân</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="container">
    <div id="content">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="margin:0;padding-left:18px;">
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-sm-4">
                <div class="card" style="border: 1px solid #ddd; padding: 20px; border-radius: 8px;">
                    <h4 class="text-center" style="margin-bottom: 20px;">Cập nhật thông tin</h4>
                    <form action="{{ route('user.profile.update') }}" method="post">
                        @csrf
                        <div class="form-block">
                            <label>Họ và tên</label>
                            <input class="form-control" type="text" name="full_name" value="{{ old('full_name', $user->full_name) }}" required>
                        </div>
                        <div class="form-block">
                            <label>Email</label>
                            <input class="form-control" type="email" value="{{ $user->email }}" disabled>
                        </div>
                        <div class="form-block">
                            <label>Số điện thoại</label>
                            <input class="form-control" type="text" name="phone" value="{{ old('phone', $user->phone) }}">
                        </div>
                        <div class="form-block">
                            <label>Địa chỉ</label>
                            <input class="form-control" type="text" name="address" value="{{ old('address', $user->address) }}">
                        </div>
                        <button type="submit" class="beta-btn primary" style="margin-top:10px;">Lưu thay đổi</button>
                    </form>
                </div>
            </div>
            <div class="col-sm-8">
                <h4>Lịch sử mua hàng</h4>
                <div class="space20">&nbsp;</div>
                @if(count($orders) > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr class="bg-primary text-white" style="background-color: #0277b8; color: white;">
                                <th>Mã ĐH</th>
                                <th>Ngày đặt</th>
                                <th>Tổng tiền</th>
                                <th>Thanh toán</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td>#{{ $order->id }}</td>
                                <td>{{ \Carbon\Carbon::parse($order->date_order)->format('d/m/Y') }}</td>
                                <td><strong style="color: #ed1c24;">{{ number_format($order->total) }} đ</strong></td>
                                <td>{{ $order->payment }}</td>
                                <td>
                                    @if($order->status == 'Mới')
                                        <span class="label label-info">Mới</span>
                                    @elseif($order->status == 'Đang giao')
                                        <span class="label label-warning">Đang giao</span>
                                    @elseif($order->status == 'Đã giao')
                                        <span class="label label-success">Đã giao</span>
                                    @elseif($order->status == 'Đã hủy')
                                        <span class="label label-danger">Đã hủy</span>
                                    @else
                                        <span class="label label-default">{{ $order->status }}</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <p>Bạn chưa có đơn hàng nào.</p>
                @endif
            </div>
        </div>
        <div class="space50">&nbsp;</div>
    </div>
</div>
@endsection
