@extends('admin.master')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Loại đồ gia dụng
                    <small>Thêm mới</small>
                </h1>
            </div>
            <div class="col-lg-7" style="padding-bottom:120px">
                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $err)
                            {{$err}}<br>
                        @endforeach
                    </div>
                @endif
                <form action="{{ route('admin.postCateAdd') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Tên loại</label>
                        <input class="form-control" name="name" value="{{ old('name') }}" placeholder="Ví dụ: Đồ gia dụng nhà bếp" />
                    </div>
                    <div class="form-group">
                        <label>Mô tả</label>
                        <textarea class="form-control" rows="3" name="description" placeholder="Mô tả nhóm sản phẩm, công dụng, không gian sử dụng...">{{ old('description') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Thêm loại</button>
                    <a href="{{ route('admin.getCateList') }}" class="btn btn-default">Quay lại</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
