@extends('layout.master')
@section('banner')
    <div class="fullwidthbanner-container">
        <div class="fullwidthbanner">
            <div class="bannercontainer">
                <div class="banner">
                    <ul>
                        @foreach ($slides as $sl)
                            <li data-transition="boxfade" data-slotamount="20" class="active-revslide"
                                style="width: 100%; height: 100%; overflow: hidden; z-index: 18; visibility: hidden; opacity: 0;">
                                <div class="slotholder" style="width:100%;height:100%;" data-duration="undefined"
                                    data-zoomstart="undefined" data-zoomend="undefined" data-rotationstart="undefined"
                                    data-rotationend="undefined" data-ease="undefined" data-bgpositionend="undefined"
                                    data-bgposition="undefined" data-kenburns="undefined" data-easeme="undefined"
                                    data-bgfit="undefined" data-bgfitend="undefined" data-owidth="undefined"
                                    data-oheight="undefined">
                                    <div class="tp-bgimg defaultimg" data-lazyload="undefined" data-bgfit="cover"
                                        data-bgposition="center center" data-bgrepeat="no-repeat" data-lazydone="undefined"
                                        src="/source/image/slide/{{ $sl->image }}"
                                        data-src="/source/image/slide/{{ $sl->image }}"
                                        style="background-color: rgba(0, 0, 0, 0); background-repeat: no-repeat; background-image: url('/source/image/slide/{{ $sl->image }}'); background-size: cover; background-position: center center; width: 100%; height: 100%; opacity: 1; visibility: inherit;">
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="tp-bannertimer"></div>
        </div>
    </div>
    <!--slider-->
@endsection

@section('content')
    <div class="container">
        <div id="content" class="space-top-none">
            <div class="main-content">
                <div class="space60">&nbsp;</div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="beta-products-list">
                            <h4>Sản phẩm mới</h4>
                            <div class="beta-products-details">
                                <p class="pull-left">{{ count($new_products) }} sản phẩm</p>
                                <div class="clearfix"></div>
                            </div>

                            <div class="row">
                                @foreach ($new_products as $new)
                                    <div class="col-sm-3">
                                        <div class="single-item">
                                            @if ($new->promotion_price != 0)
                                                <div class="ribbon-wrapper">
                                                    <div class="ribbon sale">Sale</div>
                                                </div>
                                            @endif
                                            <div class="single-item-header">
                                                <a href="{{ route('banhang.chitiet', $new->id) }}"><img
                                                        src="/source/image/product/{{ $new->image }}" alt=""
                                                        height="250px"></a>
                                            </div>
                                            <div class="single-item-body">
                                                <p class="single-item-title">{{ $new->name }}</p>
                                                <p class="single-item-price" style="font-size: 15px">
                                                    @if ($new->promotion_price == 0)
                                                        <span class="flash-sale">{{ number_format($new->unit_price) }}
                                                            vnđ</span>
                                                    @else
                                                        <span class="flash-del">{{ number_format($new->unit_price) }}
                                                            vnđ</span>
                                                        <span class="flash-sale">{{ number_format($new->promotion_price) }}
                                                            vnđ</span>
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="single-item-caption">
                                                <a class="add-to-cart pull-left"
                                                    href="{{ route('banhang.addtocart', $new->id) }}"><i
                                                        class="fa fa-shopping-cart"></i></a>
                                                <a class="add-to-cart pull-left"
                                                    href="{{ route('wishlist.add', $new->id) }}"
                                                    style="margin-left: 5px;"><i class="fa fa-heart"
                                                        style="color: #ed1c24;"></i></a>
                                                <a class="beta-btn primary"
                                                    href="{{ route('banhang.chitiet', $new->id) }}">Chi tiết <i
                                                        class="fa fa-chevron-right"></i></a>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row">{{ $new_products->links() }}</div>
                        </div> <!-- .beta-products-list -->

                        <div class="space50">&nbsp;</div>

                        <div class="beta-products-list">
                            <h4>Sản phẩm khuyến mãi</h4>
                            <div class="beta-products-details">
                                <p class="pull-left">Tìm thấy {{ count($promotion_products) }} sản phẩm</p>
                                <div class="clearfix"></div>
                            </div>
                            <div class="row">
                                @foreach ($promotion_products as $promo)
                                    <div class="col-sm-3">
                                        <div class="single-item">
                                            <div class="ribbon-wrapper">
                                                <div class="ribbon sale">Sale</div>
                                            </div>
                                            <div class="single-item-header">
                                                <a href="{{ route('banhang.chitiet', $promo->id) }}"><img
                                                        src="/source/image/product/{{ $promo->image }}" alt=""
                                                        height="250px"></a>
                                            </div>
                                            <div class="single-item-body">
                                                <p class="single-item-title">{{ $promo->name }}</p>
                                                <p class="single-item-price" style="font-size: 15px">
                                                    <span class="flash-del">{{ number_format($promo->unit_price) }}
                                                        vnđ</span>
                                                    <span class="flash-sale">{{ number_format($promo->promotion_price) }}
                                                        vnđ</span>
                                                </p>
                                            </div>
                                            <div class="single-item-caption">
                                                <a class="add-to-cart pull-left"
                                                    href="{{ route('banhang.addtocart', $promo->id) }}"><i
                                                        class="fa fa-shopping-cart"></i></a>
                                                <a class="add-to-cart pull-left"
                                                    href="{{ route('wishlist.add', $promo->id) }}"
                                                    style="margin-left: 5px;"><i class="fa fa-heart"
                                                        style="color: #ed1c24;"></i></a>
                                                <a class="beta-btn primary"
                                                    href="{{ route('banhang.chitiet', $promo->id) }}">Chi tiết <i
                                                        class="fa fa-chevron-right"></i></a>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row">{{ $promotion_products->links() }}</div>
                        </div> <!-- .beta-products-list -->

                        <div class="space50">&nbsp;</div>

                        <div class="beta-products-list">
                            <h4>Sản phẩm đề nghị</h4>
                            <div class="beta-products-details">
                                <p class="pull-left">Tìm thấy {{ count($top_products) }} sản phẩm</p>
                                <div class="clearfix"></div>
                            </div>
                            <div class="row">
                                @foreach ($top_products as $top)
                                    <div class="col-sm-3">
                                        <div class="single-item">
                                            @if ($top->promotion_price != 0)
                                                <div class="ribbon-wrapper">
                                                    <div class="ribbon sale">Sale</div>
                                                </div>
                                            @endif
                                            <div class="single-item-header">
                                                <a href="{{ route('banhang.chitiet', $top->id) }}"><img
                                                        src="/source/image/product/{{ $top->image }}" alt=""
                                                        height="250px"></a>
                                            </div>
                                            <div class="single-item-body">
                                                <p class="single-item-title">{{ $top->name }}</p>
                                                <p class="single-item-price" style="font-size: 15px">
                                                    @if ($top->promotion_price == 0)
                                                        <span class="flash-sale">{{ number_format($top->unit_price) }}
                                                            vnđ</span>
                                                    @else
                                                        <span class="flash-del">{{ number_format($top->unit_price) }}
                                                            vnđ</span>
                                                        <span
                                                            class="flash-sale">{{ number_format($top->promotion_price) }}
                                                            vnđ</span>
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="single-item-caption">
                                                <a class="add-to-cart pull-left"
                                                    href="{{ route('banhang.addtocart', $top->id) }}"><i
                                                        class="fa fa-shopping-cart"></i></a>
                                                <a class="add-to-cart pull-left"
                                                    href="{{ route('wishlist.add', $top->id) }}"
                                                    style="margin-left: 5px;"><i class="fa fa-heart"
                                                        style="color: #ed1c24;"></i></a>
                                                <a class="beta-btn primary"
                                                    href="{{ route('banhang.chitiet', $top->id) }}">Chi tiết <i
                                                        class="fa fa-chevron-right"></i></a>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row">{{ $top_products->links() }}</div>
                        </div> <!-- .beta-products-list -->

                        <div class="space50">&nbsp;</div>

                        <div class="beta-products-list">
                            <h4>Tất cả sản phẩm</h4>
                            <div class="beta-products-details">
                                <p class="pull-left">Danh mục đầy đủ — xem chi tiết và thêm vào giỏ</p>
                                <div class="clearfix"></div>
                            </div>
                            <div class="row">
                                @foreach ($all_products as $p)
                                    <div class="col-sm-3">
                                        <div class="single-item">
                                            @if ($p->promotion_price != 0)
                                                <div class="ribbon-wrapper">
                                                    <div class="ribbon sale">Sale</div>
                                                </div>
                                            @endif
                                            <div class="single-item-header">
                                                <a href="{{ route('banhang.chitiet', $p->id) }}"><img
                                                        src="/source/image/product/{{ $p->image }}" alt=""
                                                        height="250px"></a>
                                            </div>
                                            <div class="single-item-body">
                                                <p class="single-item-title">{{ $p->name }}</p>
                                                <p class="single-item-price" style="font-size: 15px">
                                                    @if ($p->promotion_price == 0)
                                                        <span class="flash-sale">{{ number_format($p->unit_price) }}
                                                            vnđ</span>
                                                    @else
                                                        <span class="flash-del">{{ number_format($p->unit_price) }}
                                                            vnđ</span>
                                                        <span class="flash-sale">{{ number_format($p->promotion_price) }}
                                                            vnđ</span>
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="single-item-caption">
                                                <a class="add-to-cart pull-left"
                                                    href="{{ route('banhang.addtocart', $p->id) }}"><i
                                                        class="fa fa-shopping-cart"></i></a>
                                                <a class="add-to-cart pull-left"
                                                    href="{{ route('wishlist.add', $p->id) }}"
                                                    style="margin-left: 5px;"><i class="fa fa-heart"
                                                        style="color: #ed1c24;"></i></a>
                                                <a class="beta-btn primary"
                                                    href="{{ route('banhang.chitiet', $p->id) }}">Chi tiết <i
                                                        class="fa fa-chevron-right"></i></a>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row">{{ $all_products->links() }}</div>
                        </div> <!-- .beta-products-list -->
                    </div>
                </div> <!-- end section with sidebar and main content -->
            </div> <!-- .main-content -->
        </div> <!-- #content -->
    </div>
@endsection
