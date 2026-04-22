@extends('admin.master')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Product
                    <small>List</small>
                </h1>
            </div>
            @if(session('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
            @endif
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Promo Price</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($product as $pr)
                    <tr class="odd gradeX" align="center">
                        <td>{{$pr->id}}</td>
                        <td>{{$pr->name}}
                            <br><img width="100px" src="/source/image/product/{{$pr->image}}">
                        </td>
                        <td>{{$pr->product_type->name}}</td>
                        <td>{{number_format($pr->unit_price)}}</td>
                        <td>{{number_format($pr->promotion_price)}}</td>
                        <td class="center"><i class="fa fa-trash-o fa-fw"></i><a href="{{ route('admin.product.getDelete', $pr->id) }}"> Delete</a></td>
                        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{ route('admin.product.getEdit', $pr->id) }}">Edit</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection
