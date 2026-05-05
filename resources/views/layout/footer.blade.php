<div id="footer" class="color-div">
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				<div class="widget">
					<h4 class="widget-title">Đồ gia dụng nổi bật</h4>
					<div>
						<ul>
							<li><a href="#"><i class="fa fa-chevron-right"></i> Dụng cụ nhà bếp</a></li>
							<li><a href="#"><i class="fa fa-chevron-right"></i> Thiết bị điện gia dụng</a></li>
							<li><a href="#"><i class="fa fa-chevron-right"></i> Vệ sinh nhà cửa</a></li>
							<li><a href="#"><i class="fa fa-chevron-right"></i> Phụ kiện phòng tắm</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="widget">
					<h4 class="widget-title">Hỗ trợ</h4>
					<div>
						<ul>
							<li><a href="{{ route('banhang.index') }}"><i class="fa fa-chevron-right"></i> Sản phẩm mới</a></li>
							<li><a href="{{ route('banhang.giohang') }}"><i class="fa fa-chevron-right"></i> Giỏ hàng</a></li>
							<li><a href="{{ route('contact.get') }}"><i class="fa fa-chevron-right"></i> Liên hệ</a></li>
							<li><a href="{{ route('user.profile') }}"><i class="fa fa-chevron-right"></i> Lịch sử đơn hàng</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="col-sm-10">
					<div class="widget">
						<h4 class="widget-title">Liên hệ shop</h4>
						<div>
							<div class="contact-info">
								<i class="fa fa-map-marker"></i>
								<p>123 Đường Láng, Đống Đa, Hà Nội - Điện thoại: 028 3456 7890</p>
								<p>{{ config('app.name') }} chuyên đồ gia dụng tiện ích cho gia đình: nhà bếp, vệ sinh, phòng tắm, phòng ngủ và thiết bị điện nhỏ.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="widget">
					<h4 class="widget-title">Nhận ưu đãi</h4>
					<form action="#" method="post">
						<input type="email" name="your_email" placeholder="Email của bạn">
						<button class="pull-right" type="submit">Đăng ký <i class="fa fa-chevron-right"></i></button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="copyright">
	<div class="container">
		<p class="pull-left">Chính sách bảo mật. (&copy;) {{ date('Y') }} {{ config('app.name') }}</p>
		<p class="pull-right pay-options">
			<a href="#"><img src="{{ asset('source/assets/dest/images/pay/master.jpg') }}" alt="" /></a>
			<a href="#"><img src="{{ asset('source/assets/dest/images/pay/pay.jpg') }}" alt="" /></a>
			<a href="#"><img src="{{ asset('source/assets/dest/images/pay/visa.jpg') }}" alt="" /></a>
			<a href="#"><img src="{{ asset('source/assets/dest/images/pay/paypal.jpg') }}" alt="" /></a>
		</p>
		<div class="clearfix"></div>
	</div>
</div>
