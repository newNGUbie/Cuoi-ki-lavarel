@extends('layout.master')
@section('content')
<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">Sản phẩm yêu thích</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb font-large">
                <a href="{{route('banhang.index')}}">Trang chủ</a> / <span>Sản phẩm yêu thích</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="container">
    <div id="content">
        @if(session('success'))
            <div class="alert alert-success">{{session('success')}}</div>
        @endif
        <div class="table-responsive">
            <table class="shop_table beta-shopping-cart-table" cellspacing="0">
                <thead>
                    <tr>
                        <th class="product-name">Sản phẩm</th>
                        <th class="product-price">Giá</th>
                        <th class="product-status">Tình trạng</th>
                        <th class="product-subtotal">Thao tác</th>
                        <th class="product-remove">Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($wishlists) > 0)
                        @foreach($wishlists as $wl)
                        <tr class="cart_item">
                            <td class="product-name">
                                <div class="media">
                                    <img class="pull-left" src="/source/image/product/{{$wl->product->image}}" alt="" height="50">
                                    <div class="media-body">
                                        <p class="font-large table-title">{{$wl->product->name}}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="product-price">
                                <span class="amount">{{number_format($wl->product->promotion_price != 0 ? $wl->product->promotion_price : $wl->product->unit_price)}} đ</span>
                            </td>
                            <td class="product-status">
                                Còn hàng
                            </td>
                            <td class="product-subtotal">
                                <a href="{{route('banhang.addtocart', $wl->product->id)}}" class="beta-btn primary text-center">Thêm vào giỏ <i class="fa fa-chevron-right"></i></a>
                            </td>
                            <td class="product-remove">
                                <a href="{{route('wishlist.remove', $wl->product->id)}}" class="remove" title="Xóa khỏi danh sách yêu thích"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-center">Chưa có sản phẩm nào trong danh sách yêu thích</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="clearfix"></div>
    </div> <!-- #content -->
</div> <!-- .container -->
@endsection
