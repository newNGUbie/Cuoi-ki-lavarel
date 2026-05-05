@extends('layout.master')
@section('content')
<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">Giỏ hàng</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb font-large">
                <a href="{{ route('banhang.index') }}">Home</a> / <span>Giỏ hàng</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="container">
    <div id="content">

        <div class="table-responsive">
            <!-- Shop Products Table -->
            <table class="shop_table beta-shopping-cart-table" cellspacing="0">
                <thead>
                    <tr>
                        <th class="product-name">Sản phẩm</th>
                        <th class="product-price">Giá</th>
                        <th class="product-status">Trạng thái</th>
                        <th class="product-quantity">Số lượng</th>
                        <th class="product-subtotal">Tổng tiền</th>
                        <th class="product-remove">Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    @if(Session::has('cart'))
                    @foreach($productCarts as $product)
                    <tr class="cart_item">
                        <td class="product-name">
                            <div class="media">
                                <img class="pull-left" src="/source/image/product/{{$product['item']->image}}" alt="" width="100px">
                                <div class="media-body">
                                    <p class="font-large table-title">{{ $product['item']->name }}</p>
                                </div>
                            </div>
                        </td>

                        <td class="product-price">
                            <span class="amount">{{ number_format($product['item']->promotion_price==0?$product['item']->unit_price:$product['item']->promotion_price) }} vnđ</span>
                        </td>

                        <td class="product-status">
                            Còn hàng
                        </td>

                        <td class="product-quantity">
                            <form action="{{ route('banhang.capnhatgiohang', $product['item']['id']) }}" method="get">
                                <input type="number" name="qty" value="{{ $product['qty'] }}" min="1" style="width: 50px">
                                <button type="submit" class="btn btn-sm btn-info"><i class="fa fa-refresh"></i></button>
                            </form>
                        </td>

                        <td class="product-subtotal">
                            <span class="amount">{{ number_format($product['price']) }} vnđ</span>
                        </td>

                        <td class="product-remove">
                            <a href="{{ route('banhang.xoagiohang', $product['item']->id) }}" class="remove" title="Remove this item"><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>

                <tfoot>
                    <tr>
                        <td colspan="6" class="actions">
                            <a href="{{ route('banhang.getdathang') }}" class="beta-btn primary" name="proceed">Tiến hành đặt hàng <i class="fa fa-chevron-right"></i></a>
                        </td>
                    </tr>
                </tfoot>
            </table>
            <!-- End of Shop Table Products -->
        </div>

        <div class="clearfix"></div>

    </div> <!-- #content -->
</div> <!-- .container -->
@endsection
