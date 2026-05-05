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
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <!-- /.col-lg-12 -->

                <div class="col-lg-12">
                    <!-- Tab links -->
                    <ul class="nav nav-tabs" style="margin-bottom: 20px;">
                        <li class="active"><a data-toggle="tab" href="#all">Tất cả ({{ count($all_bills) }})</a></li>
                        <li><a data-toggle="tab" href="#new">Mới ({{ count($bills_new) }})</a></li>
                        <li><a data-toggle="tab" href="#shipping">Đang giao ({{ count($bills_shipping) }})</a></li>
                        <li><a data-toggle="tab" href="#completed">Đã giao ({{ count($bills_completed) }})</a></li>
                        <li><a data-toggle="tab" href="#canceled">Đã hủy ({{ count($bills_canceled) }})</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="all" class="tab-pane fade in active">
                            @include('admin.order.order_table', ['bills' => $all_bills])
                        </div>
                        <div id="new" class="tab-pane fade">
                            @include('admin.order.order_table', ['bills' => $bills_new])
                        </div>
                        <div id="shipping" class="tab-pane fade">
                            @include('admin.order.order_table', ['bills' => $bills_shipping])
                        </div>
                        <div id="completed" class="tab-pane fade">
                            @include('admin.order.order_table', ['bills' => $bills_completed])
                        </div>
                        <div id="canceled" class="tab-pane fade">
                            @include('admin.order.order_table', ['bills' => $bills_canceled])
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection
