@extends('admin.master')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Slide
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

            <p><a href="{{ route('admin.slide.getAdd') }}" class="btn btn-primary">Thêm slide</a></p>

            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Hình ảnh</th>
                        <th>Link</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($slides as $sd)
                    <tr class="odd gradeX" align="center">
                        <td>{{ $sd->id }}</td>
                        <td>
                            <img width="100px" src="/source/image/slide/{{ $sd->image }}">
                        </td>
                        <td>{{ $sd->link }}</td>
                        <td class="center"><i class="fa fa-trash-o fa-fw"></i><a href="{{ route('admin.slide.getDelete', $sd->id) }}"> Xóa</a></td>
                        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{ route('admin.slide.getEdit', $sd->id) }}">Sửa</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
