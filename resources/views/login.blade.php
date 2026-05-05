@extends('layout.master')
@section('content')
	<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Đăng nhập</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb">
					<a href="{{route('banhang.index')}}">Trang chủ</a> / <span>Đăng nhập</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>

	<div class="container">
		<div id="content" class="hw-auth-wrap">
			<div class="row hw-auth-layout">
				<div class="col-sm-5">
					<div class="hw-auth-panel">
						<p class="hw-auth-kicker">Tài khoản khách hàng</p>
						<h3>Đăng nhập để mua sắm nhanh hơn</h3>
						<p>Theo dõi đơn hàng đồ gia dụng đã đặt, lưu sản phẩm yêu thích và dùng lại thông tin giao hàng ở lần mua tiếp theo.</p>
						<ul class="hw-auth-benefits">
							<li><i class="fa fa-check"></i> Xem lịch sử và trạng thái đơn hàng</li>
							<li><i class="fa fa-check"></i> Quản lý địa chỉ, số điện thoại</li>
							<li><i class="fa fa-check"></i> Lưu sản phẩm yêu thích</li>
						</ul>
					</div>
				</div>

				<div class="col-sm-7">
					<div class="hw-auth-card">
						<h4>Đăng nhập</h4>
						<p class="hw-auth-subtitle">Nhập email và mật khẩu để tiếp tục.</p>

						@if ($errors->any())
							<div class="alert alert-danger">
								<ul style="margin:0;padding-left:18px;">
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						@endif
						@if(Session::has('flag'))
							<div class="alert alert-{{ Session::get('flag') }}">{{ Session::get('message') }}</div>
						@endif

						<form action="{{ route('postlogin') }}" method="post" class="beta-form-checkout hw-auth-form">
							@csrf
							<div class="form-block">
								<label for="email">Email</label>
								<input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="ban@example.com" required autofocus>
							</div>

							<div class="form-block">
								<label for="password">Mật khẩu</label>
								<input type="password" name="password" id="password" placeholder="Nhập mật khẩu" required>
							</div>

							<div class="hw-auth-row">
								<label class="hw-checkbox">
									<input type="checkbox" name="remember" value="1" {{ old('remember') ? 'checked' : '' }}>
									<span class="hw-checkbox-box" aria-hidden="true"></span>
									<span>Ghi nhớ đăng nhập</span>
								</label>
								<a href="{{ route('getInputEmail') }}">Quên mật khẩu?</a>
							</div>

							<button type="submit" class="btn btn-primary btn-block hw-auth-submit">Đăng nhập</button>
						</form>

						<div class="hw-auth-footer">
							<span>Chưa có tài khoản?</span>
							<a href="{{ route('getsignin') }}">Đăng ký ngay</a>
						</div>

						@if(Auth::check() && in_array(Auth::user()->level, [1, 2]))
							<div class="hw-admin-note">
								<a href="{{ route('admin.getCateList') }}"><i class="fa fa-dashboard"></i> Đi tới trang quản trị</a>
							</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
