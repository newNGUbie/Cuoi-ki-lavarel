@extends('layout.master')
@section('content')
<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">Liên hệ</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb font-large">
                <a href="{{route('banhang.index')}}">Trang chủ</a> / <span>Liên hệ</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="beta-map">
    <div class="abs-fullwidth beta-map wow flipInX"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.4602324217156!2d106.68965031480072!3d10.776019462142278!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f3afbd4a6e1%3A0xc6440266e744a72d!2zOTAgTMOqIFRo4buLIFJpw6puZywgUGjGsOG7nW5nIELhur9uIFRow6BuaCwgUXXhuq1uIDEsIEjhu5MgQ2jDrSBNaW5oLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1652873322197!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
</div>
<div class="container">
    <div id="content" class="space-top-none">
        
        <div class="space50">&nbsp;</div>
        <div class="row">
            <div class="col-sm-8">
                <h2>Form Liên hệ</h2>
                <div class="space20">&nbsp;</div>
                <p>Mọi thắc mắc về sản phẩm đồ gia dụng, giao hàng hay bảo hành — vui lòng để lại lời nhắn, chúng tôi sẽ phản hồi qua email.</p>
                <div class="space20">&nbsp;</div>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <form action="{{ route('contact.post') }}" method="post" class="contact-form">
                    @csrf
                    <div class="form-block">
                        <input name="name" type="text" placeholder="Họ và tên (*)" required>
                    </div>
                    <div class="form-block">
                        <input name="email" type="email" placeholder="Email (*)" required>
                    </div>
                    <div class="form-block">
                        <textarea name="message" placeholder="Nội dung lời nhắn (*)" required style="height: 150px;"></textarea>
                    </div>
                    <div class="form-block">
                        <button type="submit" class="beta-btn primary">Gửi lời nhắn <i class="fa fa-chevron-right"></i></button>
                    </div>
                </form>
            </div>
            <div class="col-sm-4">
                <h2>Thông tin liên hệ</h2>
                <div class="space20">&nbsp;</div>

                <h6 class="contact-title">Địa chỉ</h6>
                <p>
                    90-92 Lê Thị Riêng,<br>
                    Bến Thành, Quận 1,<br>
                    Thành phố Hồ Chí Minh
                </p>
                <div class="space20">&nbsp;</div>
                <h6 class="contact-title">Điện thoại / Email</h6>
                <p>
                    <a href="mailto:biz@betadesign.com">biz@betadesign.com</a><br>
                    <a href="mailto:support@betadesign.com">support@betadesign.com</a><br>
                    Phone: 0163 296 7751
                </p>
            </div>
        </div>
    </div> <!-- #content -->
</div> <!-- .container -->
@endsection
