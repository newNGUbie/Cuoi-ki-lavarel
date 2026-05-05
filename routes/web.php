<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminOrderController;

Route::get('/', function () {
    return redirect()->route('banhang.index');
});

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
Route::post('checkout/apply-coupon', [PageController::class, 'postApplyCoupon'])->name('banhang.coupon.apply');
Route::post('checkout/remove-coupon', [PageController::class, 'postRemoveCoupon'])->name('banhang.coupon.remove');

// Gửi Email Reset Password
Route::get('/input-email', [PageController::class, 'getInputEmail'])->name('getInputEmail');
Route::post('/input-email', [PageController::class, 'postInputEmail'])->name('postInputEmail');

// Wishlist
Route::get('/wishlist', [\App\Http\Controllers\WishlistController::class, 'index'])->name('wishlist.index');
Route::get('/wishlist/add/{id}', [\App\Http\Controllers\WishlistController::class, 'add'])->name('wishlist.add');
Route::get('/wishlist/remove/{id}', [\App\Http\Controllers\WishlistController::class, 'remove'])->name('wishlist.remove');

// User Profile
Route::get('/profile', [PageController::class, 'getProfile'])->name('user.profile');
Route::post('/profile', [PageController::class, 'postProfile'])->name('user.profile.update');

// Liên hệ
Route::get('/contact', [\App\Http\Controllers\ContactController::class, 'getContact'])->name('contact.get');
Route::post('/contact', [\App\Http\Controllers\ContactController::class, 'postContact'])->name('contact.post');

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
            Route::get('them', [AdminUserController::class, 'getAdd'])->name('admin.user.getAdd');
            Route::post('them', [AdminUserController::class, 'postAdd'])->name('admin.user.postAdd');
            Route::get('sua/{id}', [AdminUserController::class, 'getEdit'])->name('admin.user.getEdit');
            Route::post('sua/{id}', [AdminUserController::class, 'postEdit'])->name('admin.user.postEdit');
            Route::get('xoa/{id}', [AdminUserController::class, 'getDelete'])->name('admin.user.getDelete');
        });

        // Order
        Route::group(['prefix' => 'order'], function () {
            Route::get('danhsach', [AdminOrderController::class, 'getList'])->name('admin.order.list');
            Route::get('xoa/{id}', [AdminOrderController::class, 'getDelete'])->name('admin.order.getDelete');
            Route::post('trangthai/{id}', [AdminOrderController::class, 'postUpdateStatus'])->name('admin.order.postUpdateStatus');
        });
        // Contact
        Route::prefix('contact')->group(function () {
            Route::get('/danhsach', [\App\Http\Controllers\AdminContactController::class, 'index'])->name('admin.contact.index');
            Route::post('/update-status/{id}', [\App\Http\Controllers\AdminContactController::class, 'postUpdateStatus'])->name('admin.contact.postUpdateStatus');
        });
        // Slide
        Route::prefix('slide')->group(function () {
            Route::get('danhsach', [\App\Http\Controllers\AdminSlideController::class, 'getList'])->name('admin.slide.getList');
            Route::get('them', [\App\Http\Controllers\AdminSlideController::class, 'getAdd'])->name('admin.slide.getAdd');
            Route::post('them', [\App\Http\Controllers\AdminSlideController::class, 'postAdd'])->name('admin.slide.postAdd');
            Route::get('sua/{id}', [\App\Http\Controllers\AdminSlideController::class, 'getEdit'])->name('admin.slide.getEdit');
            Route::post('sua/{id}', [\App\Http\Controllers\AdminSlideController::class, 'postEdit'])->name('admin.slide.postEdit');
            Route::get('xoa/{id}', [\App\Http\Controllers\AdminSlideController::class, 'getDelete'])->name('admin.slide.getDelete');
        });
    });
});
