@extends('admin.master')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tài khoản
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
                <form action="{{ route('admin.user.postEdit', $user->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Họ tên</label>
                        <input class="form-control" name="full_name" value="{{ old('full_name', $user->full_name) }}" />
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" name="email" type="email" value="{{ old('email', $user->email) }}" />
                    </div>
                    <div class="form-group">
                        <label>Mật khẩu mới</label>
                        <input class="form-control" name="password" type="password" placeholder="Bỏ trống nếu không đổi mật khẩu" />
                    </div>
                    <div class="form-group">
                        <label>Xác nhận mật khẩu mới</label>
                        <input class="form-control" name="password_confirmation" type="password" placeholder="Nhập lại mật khẩu mới" />
                    </div>
                    <div class="form-group">
                        <label>Điện thoại</label>
                        <input class="form-control" name="phone" value="{{ old('phone', $user->phone) }}" />
                    </div>
                    <div class="form-group">
                        <label>Địa chỉ</label>
                        <input class="form-control" name="address" value="{{ old('address', $user->address) }}" />
                    </div>
                    <div class="form-group">
                        <label>Quyền tài khoản</label>
                        <select class="form-control" name="level">
                            <option value="3" {{ old('level', $user->level) == 3 ? 'selected' : '' }}>Khách hàng</option>
                            <option value="2" {{ old('level', $user->level) == 2 ? 'selected' : '' }}>Nhân viên</option>
                            <option value="1" {{ old('level', $user->level) == 1 ? 'selected' : '' }}>Quản trị viên</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    <a href="{{ route('admin.user.list') }}" class="btn btn-default">Quay lại</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
