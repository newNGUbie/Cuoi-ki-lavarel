<div id="header" class="hw-header">
    <div class="header-top hw-topbar">
        <div class="container hw-topbar-inner">
            <div class="hw-top-left">
                <div class="hw-top-item"><i class="fa fa-map-marker"></i> 123 Đường Láng, Đống Đa, Hà Nội</div>
                <a href="tel:02834567890" class="hw-top-item"><i class="fa fa-phone"></i> 028 3456 7890</a>
            </div>
            <div class="hw-top-right">
                @if (Auth::check())
                    @php($isAdminUser = in_array(Auth::user()->level, [1, 2]))
                    <a href="{{ route('user.profile') }}" class="hw-top-item"><i class="fa fa-user"></i>
                        {{ Auth::user()->full_name }}</a>
                    @if ($isAdminUser)
                        <a class="hw-top-item" href="{{ route('admin.getCateList') }}"><i class="fa fa-dashboard"></i>
                            Quản trị</a>
                    @endif
                    <a href="{{ route('getlogout') }}" class="hw-top-item"><i class="fa fa-sign-out"></i> Đăng xuất</a>
                @else
                    <a href="{{ route('getsignin') }}" class="hw-top-item">Đăng ký</a>
                    <a href="{{ route('getlogin') }}" class="hw-top-item highlight">Đăng nhập</a>
                @endif
            </div>
        </div>
    </div>

    <div class="header-body hw-brandbar">
        <div class="container hw-brandbar-inner">
            <div class="hw-logo-area">
                <a href="{{ route('banhang.index') }}" id="logo" class="hw-logo">
                    <img src="https://img.icons8.com/color/96/home-automation.png" alt="Logo">
                    <span class="hw-logo-text">Gia Dụng <span class="highlight">Smart</span></span>
                </a>
            </div>

            <div class="hw-search-area">
                <form role="search" method="get" id="searchform" class="hw-search"
                    action="{{ route('banhang.search') }}">
                    <input type="text" value="{{ request('key') }}" name="key" id="s"
                        placeholder="Tìm kiếm sản phẩm..." />
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>

            <div class="hw-quick-actions">
                <div class="hw-action-item">
                    <a class="hw-icon-btn" href="{{ route('wishlist.index') }}">
                        <i class="fa fa-heart"></i>
                        <span class="hw-count">0</span>
                    </a>
                    <span class="hw-action-label">Yêu thích</span>
                </div>

                <div class="hw-action-item hw-cart">
                    <a class="hw-icon-btn" href="{{ route('banhang.giohang') }}">
                        <i class="fa fa-shopping-cart"></i>
                        <span class="hw-count">
                            @if (Session::has('cart'))
                                {{ Session('cart')->totalQty }}
                            @else
                                0
                            @endif
                        </span>
                    </a>
                    <span class="hw-action-label">Giỏ hàng</span>
                    @if (Session::has('cart'))
                        <div class="beta-dropdown cart-body hw-cart-dropdown">
                            @foreach ($productCarts as $product)
                                <div class="cart-item">
                                    <a class="cart-item-delete"
                                        href="{{ route('banhang.xoagiohang', $product['item']['id']) }}"><i
                                            class="fa fa-times"></i></a>
                                    <div class="media">
                                        <a class="pull-left"
                                            href="{{ route('banhang.chitiet', $product['item']['id']) }}"><img
                                                src="/source/image/product/{{ $product['item']['image'] ?: 'placeholder.png' }}"
                                                alt=""></a>
                                        <div class="media-body">
                                            <span class="cart-item-title">{{ $product['item']['name'] }}</span>
                                            <span class="cart-item-amount">{{ $product['qty'] }} x
                                                @if ($product['item']['promotion_price'] == 0)
                                                    {{ number_format($product['item']['unit_price']) }} đ
                                                @else
                                                    {{ number_format($product['item']['promotion_price']) }} đ
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <div class="cart-caption">
                                <div class="cart-total text-right">Tổng tiền: <span
                                        class="cart-total-value">{{ number_format($totalPrice) }} đ</span></div>
                                <div class="center hw-cart-actions">
                                    <a href="{{ route('banhang.giohang') }}" class="beta-btn primary text-center">Chi
                                        tiết</a>
                                    <a href="{{ route('banhang.getdathang') }}"
                                        class="beta-btn primary text-center">Đặt hàng</a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="header-bottom hw-nav">
        <div class="container">
            <a class="visible-xs beta-menu-toggle pull-right" href="#"><span
                    class='beta-menu-toggle-text'>Menu</span> <i class="fa fa-bars"></i></a>
            <div class="visible-xs clearfix"></div>
            <nav class="main-menu">
                <ul class="l-inline ov">
                    <li><a href="{{ route('banhang.index') }}">Trang chủ</a></li>
                    <li><a href="#">Sản phẩm</a>
                        <ul class="sub-menu">
                            @foreach ($loai_sp as $loai)
                                <li><a href="{{ route('banhang.loaisanpham', $loai->id) }}">{{ $loai->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="{{ route('wishlist.index') }}">Yêu thích</a></li>
                    <li><a href="{{ route('contact.get') }}">Liên hệ</a></li>
                </ul>
                <div class="clearfix"></div>
            </nav>
        </div>
    </div>
</div>
