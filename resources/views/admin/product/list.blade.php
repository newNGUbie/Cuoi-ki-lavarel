@extends('admin.master')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Sản phẩm gia dụng
                    <small>Danh sách</small>
                </h1>
            </div>
            @if(session('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
            @endif
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Sản phẩm</th>
                        <th>Loại</th>
                        <th>Giá bán</th>
                        <th>Giá KM</th>
                        <th>Đơn vị</th>
                        <th>Mới</th>
                        <th>Xóa</th>
                        <th>Sửa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($product as $pr)
                    <tr class="odd gradeX" align="center">
                        <td>{{$pr->id}}</td>
                        <td>{{$pr->name}}
                            <br><img width="100px" src="/source/image/product/{{$pr->image ?: 'placeholder.png'}}">
                        </td>
                        <td>{{$pr->product_type->name ?? 'Chưa phân loại'}}</td>
                        <td>{{number_format($pr->unit_price)}} đ</td>
                        <td>{{number_format($pr->promotion_price)}} đ</td>
                        <td>{{$pr->unit}}</td>
                        <td>{{$pr->new ? 'Có' : 'Không'}}</td>
                        <td class="center"><i class="fa fa-trash-o fa-fw"></i><a href="{{ route('admin.product.getDelete', $pr->id) }}" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')"> Xóa</a></td>
                        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{ route('admin.product.getEdit', $pr->id) }}">Sửa</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
