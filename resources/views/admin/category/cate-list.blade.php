@extends('admin.master')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Loại đồ gia dụng
                    <small>Danh sách</small>
                </h1>
                <a href="{{ route('admin.getCateAdd') }}" class="btn btn-primary" style="margin-bottom: 15px;">
                    <i class="fa fa-plus"></i> Thêm loại sản phẩm
                </a>
            </div>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Tên loại</th>
                        <th>Mô tả</th>
                        <th>Xóa</th>
                        <th>Sửa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cates as $cate)
                    <tr class="odd gradeX" align="center">
                        <td>{{ $cate->id }}</td>
                        <td>{{ $cate->name }}</td>
                        <td>{{ $cate->description }}</td>
                        <td class="center"><i class="fa fa-trash-o fa-fw"></i><a href="{{ route('admin.getCateDelete', $cate->id) }}" onclick="return confirm('Bạn có chắc muốn xóa loại sản phẩm này?')"> Xóa</a></td>
                        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{ route('admin.getCateEdit', $cate->id) }}">Sửa</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
