@extends('admin.master')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Sản phẩm gia dụng
                    <small>Cập nhật</small>
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
                <form action="{{ route('admin.product.postEdit', $product->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Loại sản phẩm</label>
                        <select class="form-control" name="id_type">
                            @foreach($cate as $c)
                            <option value="{{$c->id}}" @if(old('id_type', $product->id_type) == $c->id) selected @endif>{{$c->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tên sản phẩm</label>
                        <input class="form-control" name="name" value="{{ old('name', $product->name) }}"/>
                    </div>
                    <div class="form-group">
                        <label>Mô tả</label>
                        <textarea class="form-control" rows="3" name="description">{{ old('description', $product->description) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Giá bán</label>
                        <input class="form-control" name="unit_price" value="{{ old('unit_price', $product->unit_price) }}"/>
                    </div>
                    <div class="form-group">
                        <label>Giá khuyến mãi</label>
                        <input class="form-control" name="promotion_price" value="{{ old('promotion_price', $product->promotion_price) }}"/>
                    </div>
                    <div class="form-group">
                        <label>Tên ảnh</label>
                        <input class="form-control" name="image" value="{{ old('image', $product->image ?: 'placeholder.png') }}"/>
                    </div>
                    <div class="form-group">
                        <label>Đơn vị tính</label>
                        <input class="form-control" name="unit" value="{{ old('unit', $product->unit) }}"/>
                    </div>
                    <div class="form-group">
                        <label>Sản phẩm mới</label>
                        <label class="radio-inline">
                            <input name="new" value="1" @if(old('new', $product->new) == 1) checked @endif type="radio">Có
                        </label>
                        <label class="radio-inline">
                            <input name="new" value="0" @if(old('new', $product->new) == 0) checked @endif type="radio">Không
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    <a href="{{ route('admin.product.list') }}" class="btn btn-default">Quay lại</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
