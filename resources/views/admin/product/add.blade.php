@extends('admin.master')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Sản phẩm gia dụng
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
                <form action="{{ route('admin.product.postAdd') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Loại sản phẩm</label>
                        <select class="form-control" name="id_type">
                            <option value="">Chọn loại đồ gia dụng</option>
                            @foreach($cate as $c)
                            <option value="{{$c->id}}" {{ old('id_type') == $c->id ? 'selected' : '' }}>{{$c->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tên sản phẩm</label>
                        <input class="form-control" name="name" value="{{ old('name') }}" placeholder="Ví dụ: Chảo chống dính 24cm" />
                    </div>
                    <div class="form-group">
                        <label>Mô tả</label>
                        <textarea class="form-control" rows="3" name="description" placeholder="Mô tả chất liệu, công dụng, kích thước...">{{ old('description') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Giá bán</label>
                        <input class="form-control" name="unit_price" value="{{ old('unit_price') }}" placeholder="Nhập giá bán" />
                    </div>
                    <div class="form-group">
                        <label>Giá khuyến mãi</label>
                        <input class="form-control" name="promotion_price" value="{{ old('promotion_price', 0) }}" placeholder="Nhập 0 nếu không khuyến mãi"/>
                    </div>
                    <div class="form-group">
                        <label>Tên ảnh</label>
                        <input class="form-control" name="image" value="{{ old('image', 'placeholder.png') }}" placeholder="Ví dụ: chao-chong-dinh.jpg" />
                    </div>
                    <div class="form-group">
                        <label>Đơn vị tính</label>
                        <input class="form-control" name="unit" value="{{ old('unit', 'cái') }}" placeholder="cái, bộ, hộp, chai..." />
                    </div>
                    <div class="form-group">
                        <label>Sản phẩm mới</label>
                        <label class="radio-inline">
                            <input name="new" value="1" {{ old('new', 1) == 1 ? 'checked' : '' }} type="radio">Có
                        </label>
                        <label class="radio-inline">
                            <input name="new" value="0" {{ old('new') == 0 && old('new') !== null ? 'checked' : '' }} type="radio">Không
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
                    <button type="reset" class="btn btn-default">Nhập lại</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
