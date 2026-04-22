@extends('admin.master')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Order
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
                        <th>Customer</th>
                        <th>Date</th>
                        <th>Products</th>
                        <th>Total</th>
                        <th>Payment</th>
                        <th>Note</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bill as $b)
                    <tr class="odd gradeX" align="center">
                        <td>{{$b->id}}</td>
                        <td>{{$b->customer->name}}</td>
                        <td>{{$b->date_order}}</td>
                        <td>
                            <ul style="list-style: none; padding-left: 0; text-align: left; font-size: 13px;">
                                @foreach($b->bill_detail as $detail)
                                    <li>• {{ $detail->product->name }} (x{{ $detail->quantity }})</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{number_format($b->total)}}</td>
                        <td>{{$b->payment}}</td>
                        <td>{{$b->note}}</td>
                        <td class="center"><i class="fa fa-trash-o fa-fw"></i><a href="{{ route('admin.order.getDelete', $b->id) }}"> Delete</a></td>
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
