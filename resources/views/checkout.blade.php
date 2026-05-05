@extends('layout.master')
@section('content')
    <div class="inner-header">
        <div class="container">
            <div class="pull-left">
                <h6 class="inner-title">Đặt hàng</h6>
            </div>
            <div class="pull-right">
                <div class="beta-breadcrumb">
                    <a href="{{ route('banhang.index') }}">Trang chủ</a> / <span>Đặt hàng</span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="container">
        <div id="content">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul style="margin: 0; padding-left: 18px;">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="row" style="margin-bottom: 15px;">
                <div class="col-sm-6">
                    <h5>Mã giảm giá</h5>
                    <form action="{{ route('banhang.coupon.apply') }}" method="post" class="form-inline">
                        @csrf
                        <input type="text" name="code" class="form-control" style="width: 60%;" placeholder="Nhập mã" value="{{ old('code', $appliedCoupon->code ?? '') }}">
                        <button type="submit" class="btn btn-primary" style="margin-left: 6px;">Áp dụng</button>
                    </form>
                </div>
                <div class="col-sm-6 text-right" style="padding-top: 28px;">
                    @if ($appliedCoupon)
                        <form action="{{ route('banhang.coupon.remove') }}" method="post" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-default">Bỏ mã</button>
                        </form>
                    @endif
                </div>
            </div>

            <form action="{{ route('banhang.postdathang') }}" method="post" class="beta-form-checkout">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <h4>Thông tin giao hàng</h4>
                        <div class="space20">&nbsp;</div>
                        <div class="form-block">
                            <label for="name">Họ tên*</label>
                            <input type="text" id="name" placeholder="Họ tên" name="name" value="{{ old('name', Auth::user()->full_name ?? '') }}" required>
                        </div>
                        <div class="form-block">
                            <label>Giới tính </label>
                            <input id="gender_male" type="radio" class="input-radio" name="gender" value="nam" {{ old('gender', 'nam') == 'nam' ? 'checked' : '' }} style="width: 10%"><span style="margin-right: 10%">Nam</span>
                            <input id="gender_female" type="radio" class="input-radio" name="gender" value="nữ" {{ old('gender') == 'nữ' ? 'checked' : '' }} style="width: 10%"><span>Nữ</span>
                        </div>

                        <div class="form-block">
                            <label for="email">Email*</label>
                            <input type="email" id="email" required placeholder="example@gmail.com" name="email" value="{{ old('email', Auth::user()->email ?? '') }}">
                        </div>

                        <div class="form-block">
                            <label for="adress">Địa chỉ*</label>
                            <input type="text" id="adress" placeholder="Số nhà, đường, phường/xã..." name="address" value="{{ old('address', Auth::user()->address ?? '') }}" required>
                        </div>

                        <div class="form-block">
                            <label for="phone">Điện thoại*</label>
                            <input type="text" id="phone" name="phone_number" value="{{ old('phone_number', Auth::user()->phone ?? '') }}" required>
                        </div>

                        <div class="form-block">
                            <label for="shipping_fee_id">Khu vực giao hàng *</label>
                            <select name="shipping_fee_id" id="shipping_fee_id" class="form-control" required>
                                @foreach ($shippingFees as $sf)
                                    <option value="{{ $sf->id }}" {{ (int) old('shipping_fee_id', $selectedShippingId) === (int) $sf->id ? 'selected' : '' }}>
                                        {{ $sf->name }}
                                        @if ($sf->city)
                                            ({{ $sf->city }})
                                        @endif
                                        — {{ number_format($sf->fee) }} đ
                                        @if ($sf->free_shipping_min_total)
                                            | Freeship từ {{ number_format($sf->free_shipping_min_total) }} đ
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-block">
                            <label for="notes">Ghi chú</label>
                            <textarea id="notes" name="notes">{{ old('notes') }}</textarea>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="your-order">
                            <div class="your-order-head"><h5>Đơn hàng của bạn</h5></div>
                            <div class="your-order-body" style="padding: 0px 10px">
                                <div class="your-order-item">
                                    <div>
                                    @if(Session::has('cart'))
                                        @foreach($productCarts as $product)
                                        <div class="media">
                                            <img width="25%" src="/source/image/product/{{ $product['item']['image'] }}" alt="" class="pull-left">
                                            <div class="media-body">
                                                <p class="font-large">{{ $product['item']['name'] }}</p>
                                                <span class="cart-item-amount">{{ $product['qty'] }}*<span>
                                                @if($product['item']['promotion_price']==0)
                                                    {{ number_format($product['item']['unit_price']) }}@else
                                                    {{ number_format($product['item']['promotion_price']) }}
                                                @endif
                                            </span></span>
                                            @php
                                            $dongia=$product['item']['promotion_price']==0?$product['item']['unit_price']:$product['item']['promotion_price'];
                                            $thanhtien=$dongia * $product['qty'];
                                            @endphp
                                            <span class="color-gray your-order-info">Số lượng: {{ $product['qty'] }} </span>
                                            <span class="color-gray your-order-info">Thành tiền: {{ number_format($thanhtien) }} đồng</span>
                                        </div>
                                    @endforeach
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="your-order-item">
                                    <div class="pull-left"><p class="your-order-f18">Tạm tính:</p></div>
                                    <div class="pull-right"><h5 class="color-black">{{ number_format($subtotal) }}</h5></div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="your-order-item">
                                    <div class="pull-left"><p class="your-order-f18">Giảm giá:</p></div>
                                    <div class="pull-right"><h5 class="color-black">-{{ number_format($discountAmount) }}</h5></div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="your-order-item">
                                    <div class="pull-left"><p class="your-order-f18">Phí vận chuyển:</p></div>
                                    <div class="pull-right"><h5 class="color-black">{{ number_format($shippingAmount) }}</h5></div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="your-order-item">
                                    <div class="pull-left"><p class="your-order-f18">Tổng thanh toán:</p></div>
                                    <div class="pull-right"><h5 class="color-black" style="color:#ed1c24;">{{ number_format($grandTotal) }}</h5></div>
                                    <div class="clearfix"></div>
                                </div>
                                @endif
                            </div>
                            <div class="your-order-head"><h5>Hình thức thanh toán</h5></div>

                            <div class="your-order-body">
                                <ul class="payment_methods methods">
                                    <li class="payment_method_bacs">
                                        <input id="payment_method_bacs" type="radio" class="input-radio" name="payment_method" value="COD" {{ old('payment_method', 'COD') == 'COD' ? 'checked' : '' }} data-order_button_text="">
                                        <label for="payment_method_bacs">Thanh toán khi nhận hàng </label>
                                        <div class="payment_box payment_method_bacs" style="display: block;">
                                            Cửa hàng sẽ gửi hàng đến địa chỉ của bạn, bạn xem hàng rồi thanh toán tiền cho nhân viên giao hàng
                                        </div>
                                    </li>

                                    <li class="payment_method_cheque">
                                        <input id="payment_method_atm" type="radio" class="input-radio" name="payment_method" value="ATM" {{ old('payment_method') == 'ATM' ? 'checked' : '' }} data-order_button_text="">
                                        <label for="payment_method_atm">Chuyển khoản </label>
                                        <div class="payment_box payment_method_cheque" style="display: none;">
                                            Chuyển tiền đến tài khoản sau:
                                            <br>Số tài khoản: 123 456 789
                                            <br>Chủ TK: Nguyễn A
                                            <br>Ngân hàng ACB, Chi nhánh TPHCM
                                        </div>
                                    </li>

                                    <li class="payment_method_cheque">
                                        <input id="payment_method_vnpay" type="radio" class="input-radio" name="payment_method" value="VNPAY" {{ old('payment_method') == 'VNPAY' ? 'checked' : '' }} data-order_button_text="">
                                        <label for="payment_method_vnpay">Thanh toán online</label>
                                    </li>

                                </ul>
                            </div>

                            <div class="text-center"><button type="submit" class="beta-btn primary">Đặt hàng <i class="fa fa-chevron-right"></i></button></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
