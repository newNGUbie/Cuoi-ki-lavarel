@extends('admin.master')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Product
                    <small>Add</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
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
                        <label>Category</label>
                        <select class="form-control" name="id_type">
                            <option value="">Please Select Category</option>
                            @foreach($cate as $c)
                            <option value="{{$c->id}}">{{$c->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Product Name</label>
                        <input class="form-control" name="name" placeholder="Please Enter Product Name" />
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" rows="3" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Unit Price</label>
                        <input class="form-control" name="unit_price" placeholder="Please Enter Price" />
                    </div>
                    <div class="form-group">
                        <label>Promotion Price</label>
                        <input class="form-control" name="promotion_price" placeholder="Please Enter Promotion Price" value="0"/>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input class="form-control" name="image" placeholder="Please Enter Image Name" />
                    </div>
                    <div class="form-group">
                        <label>Unit</label>
                        <input class="form-control" name="unit" placeholder="Please Enter Unit" />
                    </div>
                    <div class="form-group">
                        <label>New</label>
                        <label class="radio-inline">
                            <input name="new" value="1" checked="" type="radio">Yes
                        </label>
                        <label class="radio-inline">
                            <input name="new" value="0" type="radio">No
                        </label>
                    </div>
                    <button type="submit" class="btn btn-default">Product Add</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                </form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection
