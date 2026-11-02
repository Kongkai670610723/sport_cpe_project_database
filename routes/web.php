<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;

// Public Routes (ดูหน้าแรก, ค้นหา/ดูรายละเอียดสินค้า, และดูรายการคูปองได้โดยไม่ต้องเข้าสู่ระบบ)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('/products', ProductController::class)->only(['index', 'show']);
Route::get('/vouchers', [VoucherController::class, 'index'])->name('vouchers.index');

// Authenticated Member Routes (บังคับเข้าสู่ระบบก่อนเข้าตะกร้า, เพิ่ม/ลดสินค้า, เก็บโค้ด, สั่งซื้อ และจัดการโปรไฟล์)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::resource('/cart', CartController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::post('/vouchers', [VoucherController::class, 'store'])->name('vouchers.store');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::resource('/orders', OrderController::class)->only(['index', 'store', 'show']);
});

// Admin Portal Routes (ป้องกันสิทธิ์ระดับ Route เฉพาะผู้ดูแลระบบ role = admin)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('/orders', AdminController::class)->only(['update']);
    Route::resource('/products', AdminController::class)->only(['update']);
});

require __DIR__.'/auth.php';
