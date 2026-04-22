<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function getCateList(){
        $cates = Category::all();
        return view('admin.category.cate-list', compact('cates'));
    }

    public function getCateAdd(){
        return view('admin.category.cate-add');
    }

    public function postCateAdd(Request $request){
        $request->validate(
            ['name'=>'required|unique:type_products,name'],
            ['name.required'=>'Bạn chưa nhập tên loại sản phẩm', 'name.unique'=>'Tên loại sản phẩm đã tồn tại']
        );
        $cate = new Category();
        $cate->name = $request->name;
        $cate->description = $request->description;
        $cate->image = ""; // Placeholder if no image upload handled yet
        $cate->save();
        return redirect()->route('admin.getCateList')->with('success', 'Thêm thành công');
    }

    public function getCateDelete($id){
        $cate = Category::find($id);
        $cate->delete();
        return redirect()->route('admin.getCateList')->with('success', 'Xóa thành công');
    }

    public function getCateEdit($id){
        $cate = Category::find($id);
        return view('admin.category.cate-edit', compact('cate'));
    }

    public function postCateEdit(Request $request, $id){
        $request->validate(
            ['name'=>'required'],
            ['name.required'=>'Bạn chưa nhập tên loại sản phẩm']
        );
        $cate = Category::find($id);
        $cate->name = $request->name;
        $cate->description = $request->description;
        $cate->save();
        return redirect()->route('admin.getCateList')->with('success', 'Sửa thành công');
    }
}
