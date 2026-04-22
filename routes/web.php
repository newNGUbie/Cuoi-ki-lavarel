<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminOrderController;

// Trang chủ
Route::get('/trangchu', [PageController::class, 'getIndex'])->name('banhang.index');

// Chi tiết sản phẩm
Route::get('/chitiet/{sanpham_id}', [PageController::class, 'getChiTiet'])->name('banhang.chitiet');

// Thêm vào giỏ hàng
Route::get('/add-to-cart/{id}', [PageController::class, 'addToCart'])->name('banhang.addtocart');

// Loại sản phẩm
Route::get('/loai-sanpham/{type}', [PageController::class, 'getLoaiSp'])->name('banhang.loaisanpham');

// Đăng ký và đăng nhập của khách hàng
Route::get('/dangky', [PageController::class, 'getSignin'])->name('getsignin');
Route::post('/dangky', [PageController::class, 'postSignin'])->name('postsignin');

Route::get('/dangnhap', [PageController::class, 'getLogin'])->name('getlogin');
Route::post('/dangnhap', [PageController::class, 'postLogin'])->name('postlogin');

Route::get('/dangxuat', [PageController::class, 'getLogout'])->name('getlogout');

// Giỏ hàng
Route::get('/gio-hang', [PageController::class, 'getGioHang'])->name('banhang.giohang');

// Xóa sản phẩm khỏi giỏ hàng
Route::get('/del-cart/{id}', [PageController::class, 'delCartItem'])->name('banhang.xoagiohang');

// Cập nhật giỏ hàng
Route::get('/update-cart/{id}', [PageController::class, 'getUpdateCart'])->name('banhang.capnhatgiohang');

// Tìm kiếm
Route::get('/search', [PageController::class, 'getSearch'])->name('banhang.search');

// Đặt hàng
Route::get('checkout', [PageController::class, 'getCheckout'])->name('banhang.getdathang');
Route::post('checkout', [PageController::class, 'postCheckout'])->name('banhang.postdathang');

// ADMIN ROUTES
Route::get('/admin/dangnhap', [UserController::class, 'getLogin'])->name('admin.getLogin');
Route::post('/admin/dangnhap', [UserController::class, 'postLogin'])->name('admin.postLogin');
Route::get('/admin/dangxuat', [UserController::class, 'getLogout'])->name('admin.getLogout');

Route::prefix('admin')->group(function () {
    Route::middleware(['adminLogin'])->group(function () {
        // Category
        Route::group(['prefix' => 'category'], function () {
            Route::get('danhsach', [CategoryController::class, 'getCateList'])->name('admin.getCateList');
            Route::get('them', [CategoryController::class, 'getCateAdd'])->name('admin.getCateAdd');
            Route::post('them', [CategoryController::class, 'postCateAdd'])->name('admin.postCateAdd');
            Route::get('xoa/{id}', [CategoryController::class, 'getCateDelete'])->name('admin.getCateDelete');
            Route::get('sua/{id}', [CategoryController::class, 'getCateEdit'])->name('admin.getCateEdit');
            Route::post('sua/{id}', [CategoryController::class, 'postCateEdit'])->name('admin.postCateEdit');
        });

        // Product
        Route::group(['prefix' => 'product'], function () {
            Route::get('danhsach', [AdminProductController::class, 'getList'])->name('admin.product.list');
            Route::get('them', [AdminProductController::class, 'getAdd'])->name('admin.product.getAdd');
            Route::post('them', [AdminProductController::class, 'postAdd'])->name('admin.product.postAdd');
            Route::get('xoa/{id}', [AdminProductController::class, 'getDelete'])->name('admin.product.getDelete');
            Route::get('sua/{id}', [AdminProductController::class, 'getEdit'])->name('admin.product.getEdit');
            Route::post('sua/{id}', [AdminProductController::class, 'postEdit'])->name('admin.product.postEdit');
        });

        // User
        Route::group(['prefix' => 'user'], function () {
            Route::get('danhsach', [AdminUserController::class, 'getList'])->name('admin.user.list');
            Route::get('xoa/{id}', [AdminUserController::class, 'getDelete'])->name('admin.user.getDelete');
        });

        // Order
        Route::group(['prefix' => 'order'], function () {
            Route::get('danhsach', [AdminOrderController::class, 'getList'])->name('admin.order.list');
            Route::get('xoa/{id}', [AdminOrderController::class, 'getDelete'])->name('admin.order.getDelete');
        });
    });
});
