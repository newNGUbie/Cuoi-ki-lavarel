<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class AdminProductController extends Controller
{
    public function getList(){
        $product = Product::orderBy('id', 'DESC')->get();
        return view('admin.product.list', compact('product'));
    }

    public function getAdd(){
        $cate = Category::all();
        return view('admin.product.add', compact('cate'));
    }

    public function postAdd(Request $request){
        $request->validate(
            [
                'name'=>'required|unique:products,name',
                'id_type'=>'required',
                'unit_price'=>'required|numeric',
            ],
            [
                'name.required'=>'Bạn chưa nhập tên sản phẩm',
                'name.unique'=>'Tên sản phẩm đã tồn tại',
                'id_type.required'=>'Bạn chưa chọn loại sản phẩm',
                'unit_price.required'=>'Bạn chưa nhập giá sản phẩm',
            ]
        );

        $product = new Product();
        $product->name = $request->name;
        $product->id_type = $request->id_type;
        $product->description = $request->description;
        $product->unit_price = $request->unit_price;
        $product->promotion_price = $request->promotion_price;
        $product->image = $request->image ?: 'placeholder.png';
        $product->unit = $request->unit;
        $product->new = $request->new;
        $product->save();

        return redirect()->route('admin.product.list')->with('success', 'Thêm thành công');
    }

    public function getDelete($id){
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('admin.product.list')->with('success', 'Xóa thành công');
    }

    public function getEdit($id){
        $product = Product::find($id);
        $cate = Category::all();
        return view('admin.product.edit', compact('product', 'cate'));
    }

    public function postEdit(Request $request, $id){
        $request->validate(
            [
                'name'=>'required',
                'id_type'=>'required',
                'unit_price'=>'required|numeric',
            ],
            [
                'name.required'=>'Bạn chưa nhập tên sản phẩm',
                'id_type.required'=>'Bạn chưa chọn loại sản phẩm',
                'unit_price.required'=>'Bạn chưa nhập giá sản phẩm',
            ]
        );

        $product = Product::find($id);
        $product->name = $request->name;
        $product->id_type = $request->id_type;
        $product->description = $request->description;
        $product->unit_price = $request->unit_price;
        $product->promotion_price = $request->promotion_price;
        $product->image = $request->image ?: 'placeholder.png';
        $product->unit = $request->unit;
        $product->new = $request->new;
        $product->save();

        return redirect()->route('admin.product.list')->with('success', 'Sửa thành công');
    }
}
