@extends('layout.master')
@section('content')
<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">Sản phẩm {{ $loai_sp->name }}</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb font-large">
                <a href="{{ route('banhang.index') }}">Home</a> / <span>Sản phẩm</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="container">
    <div id="content" class="space-top-none">
        <div class="main-content">
            <div class="space60">&nbsp;</div>
            <div class="row">
                <div class="col-sm-3">
                    <ul class="aside-menu">
                        @foreach($loai as $l)
                        <li><a href="{{ route('banhang.loaisanpham', $l->id) }}">{{ $l->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-sm-9">
                    <div class="beta-products-list">
                        <h4>{{ $loai_sp->name }}</h4>
                        <div class="beta-products-details">
                            <p class="pull-left">Tìm thấy {{ count($sp_theoloai) }} sản phẩm</p>
                            <div class="clearfix"></div>
                        </div>

                        <div class="row">
                            @foreach($sp_theoloai as $sp)
                            <div class="col-sm-4">
                                <div class="single-item">
                                    @if($sp->promotion_price != 0)
                                    <div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
                                    @endif
                                    <div class="single-item-header">
                                        <a href="{{ route('banhang.chitiet', $sp->id) }}"><img src="/source/image/product/{{$sp->image}}" alt="" height="250px"></a>
                                    </div>
                                    <div class="single-item-body">
                                        <p class="single-item-title">{{ $sp->name }}</p>
                                        <p class="single-item-price" style="font-size: 15px">
                                            @if($sp->promotion_price == 0)
                                            <span class="flash-sale">{{ number_format($sp->unit_price) }} vnđ</span>
                                            @else
                                            <span class="flash-del">{{ number_format($sp->unit_price) }} vnđ</span>
                                            <span class="flash-sale">{{ number_format($sp->promotion_price) }} vnđ</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="single-item-caption">
                                        <a class="add-to-cart pull-left" href="{{ route('banhang.addtocart', $sp->id) }}"><i class="fa fa-shopping-cart"></i></a>
                                        <a class="add-to-cart pull-left" href="{{ route('wishlist.add', $sp->id) }}" style="margin-left: 5px;"><i class="fa fa-heart" style="color: #ed1c24;"></i></a>
                                        <a class="beta-btn primary" href="{{ route('banhang.chitiet', $sp->id) }}">Chi tiết <i class="fa fa-chevron-right"></i></a>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div> <!-- .beta-products-list -->

                    <div class="space50">&nbsp;</div>

                </div>
            </div> <!-- end section with sidebar and main content -->


        </div> <!-- .main-content -->
    </div> <!-- #content -->
</div> <!-- .container -->
@endsection
