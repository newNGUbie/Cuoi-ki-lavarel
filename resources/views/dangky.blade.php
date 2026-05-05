@extends('layout.master')
@section('content')
    <div class="inner-header">
        <div class="container">
            <div class="pull-left">
                <h6 class="inner-title">Đăng ký</h6>
            </div>
            <div class="pull-right">
                <div class="beta-breadcrumb">
                    <a href="{{route('banhang.index')}}">Trang chủ</a> / <span>Đăng ký</span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="container">
        <div id="content">
            <form action="{{ route('postsignin') }}" method="post" class="beta-form-checkout">
                @csrf
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                        @if (count($errors)>0)
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $err)
                                    {{ $err }}<br>
                                @endforeach
                            </div>
                        @endif
                        @if(Session::has('success'))
                            <div class="alert alert-success">{{ Session::get('success') }}</div>
                        @endif

                        <h4>Đăng ký tài khoản mua đồ gia dụng</h4>
                        <div class="space20">&nbsp;</div>

                        <div class="form-block">
                            <label for="email">Email*</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required>
                        </div>

                        <div class="form-block">
                            <label for="fullname">Họ và tên*</label>
                            <input type="text" name="fullname" id="fullname" value="{{ old('fullname') }}" required>
                        </div>

                        <div class="form-block">
                            <label for="address">Địa chỉ nhận hàng*</label>
                            <input type="text" name="address" id="address" value="{{ old('address') }}" placeholder="Số nhà, đường, phường/xã, quận/huyện..." required>
                        </div>

                        <div class="form-block">
                            <label for="phone">Số điện thoại*</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone') }}" required>
                        </div>

                        <div class="form-block">
                            <label for="password">Mật khẩu*</label>
                            <input type="password" name="password" id="password" required>
                        </div>

                        <div class="form-block">
                            <label for="repassword">Nhập lại mật khẩu*</label>
                            <input type="password" name="repassword" id="repassword" required>
                        </div>

                        <div class="form-block">
                            <button type="submit" class="btn btn-primary">Đăng ký</button>
                        </div>
                    </div>
                    <div class="col-sm-3"></div>
                </div>
            </form>
        </div>
    </div>
@endsection
