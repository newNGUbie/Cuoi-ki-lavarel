@extends('admin.master')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Liên hệ
                    <small>Danh sách</small>
                </h1>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Tên khách hàng</th>
                        <th>Email</th>
                        <th>Nội dung</th>
                        <th width="22%">Trạng thái &amp; phản hồi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contacts as $ct)
                    <tr class="odd gradeX">
                        <td align="center">{{ $ct->id }}</td>
                        <td>{{ $ct->name }}</td>
                        <td>{{ $ct->email }}</td>
                        <td>{{ $ct->message }}</td>
                        <td>
                            <form action="{{ route('admin.contact.postUpdateStatus', $ct->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Trạng thái</label>
                                    <select name="status" class="form-control">
                                        <option value="Chưa liên hệ" {{ $ct->status == 'Chưa liên hệ' ? 'selected' : '' }}>Chưa liên hệ</option>
                                        <option value="Đang xử lý" {{ $ct->status == 'Đang xử lý' ? 'selected' : '' }}>Đang xử lý</option>
                                        <option value="Đã liên hệ" {{ $ct->status == 'Đã liên hệ' ? 'selected' : '' }}>Đã liên hệ</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Phản hồi (gửi email cho khách nếu có nội dung)</label>
                                    <textarea name="reply_message" class="form-control" rows="3" placeholder="Nhập nội dung phản hồi...">{{ old('reply_message', $ct->reply_message) }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm">Lưu &amp; gửi phản hồi</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
