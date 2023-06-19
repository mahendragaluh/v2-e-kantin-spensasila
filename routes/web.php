<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\User\KeranjangController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth','CekLevel:1'])->group(function () {
    Route::get('dashboard-admin', [App\Http\Controllers\Admin\HomeAdminController::class, 'index'])->name('dashboard.admin');

    Route::get('users-export', [App\Http\Controllers\Admin\HomeAdminController::class, 'export'])->name('users.export');
    Route::post('users-import', [App\Http\Controllers\Admin\HomeAdminController::class, 'import'])->name('users.import');

    Route::get('pengguna/users', [App\Http\Controllers\Admin\HomeAdminController::class, 'users'])->name('pengguna.users');
    Route::post('pengguna/users', [App\Http\Controllers\Admin\HomeAdminController::class, 'create_users'])->name('create.users');

    Route::get('pengguna/level', [App\Http\Controllers\Admin\HomeAdminController::class, 'level'])->name('pengguna.level');
    Route::post('/pengguna/level', [App\Http\Controllers\Admin\HomeAdminController::class, 'store_level'])->name('store.level');
    Route::post('/pengguna/level{id}', [App\Http\Controllers\Admin\HomeAdminController::class, 'update_level'])->name('update.level');

    Route::get('menu', [App\Http\Controllers\Admin\HomeAdminController::class, 'menu'])->name('menu.admin');
    Route::post('/menu', [App\Http\Controllers\Admin\HomeAdminController::class, 'store_menu'])->name('store.menu');
    Route::post('/menu{id}', [App\Http\Controllers\Admin\HomeAdminController::class, 'update_menu'])->name('update.menu');
    Route::delete('/menu{id}', [App\Http\Controllers\Admin\HomeAdminController::class, 'destroy_menu'])->name('destroy.menu');

    Route::get('admin/order', [App\Http\Controllers\Admin\HomeAdminController::class, 'order'])->name('order.admin');
});

Route::middleware(['auth','CekLevel:2'])->group(function () {
    Route::get('kasir-dashboard', [App\Http\Controllers\Kasir\HomeKasirController::class, 'index'])->name('dashboard.kasir');
    Route::get('top-up', [App\Http\Controllers\Kasir\SaldoController::class, 'index'])->name('top_up.kasir');
    Route::get('/top-up{id}', [App\Http\Controllers\Kasir\SaldoController::class, 'add_topUp'])->name('add.top_up');
    Route::post('/top-up{id}', [App\Http\Controllers\Kasir\SaldoController::class, 'update'])->name('update.top_up');

});

Route::middleware(['auth', 'CekLevel:3'])->group(function () {
    Route::get('dashboard-pengelola', [App\Http\Controllers\Pengelola\HomePengelolaController::class, 'index'])->name('pengelola.dashboard');
    Route::get('menu', [App\Http\Controllers\Pengelola\HomePengelolaController::class, 'menu'])->name('pengelola.menu');
    Route::post('/menu', [App\Http\Controllers\Pengelola\HomePengelolaController::class, 'store_menu'])->name('pengelola.store.menu');
    Route::get('/menu{id}', [App\Http\Controllers\Pengelola\HomePengelolaController::class, 'edit_menu'])->name('pengelola.edit.menu');
    Route::post('/menu{id}', [App\Http\Controllers\Pengelola\HomePengelolaController::class, 'update_menu'])->name('pengelola.update.menu');
    Route::delete('/menu{id}', [App\Http\Controllers\Pengelola\HomePengelolaController::class, 'destroy_menu'])->name('pengelola.destroy.menu');

    Route::get('transaksi/pesanan-baru', [App\Http\Controllers\Pengelola\TransaksiController::class, 'index'])->name('pengelola.transaksi');
    Route::get('transaksi/pesanan-baru/detail/{id}', [App\Http\Controllers\Pengelola\TransaksiController::class, 'detail'])->name('pengelola.transaksi.detail');
    Route::get('transaksi/konfirmasi/{id}', [App\Http\Controllers\Pengelola\TransaksiController::class, 'konfirmasi'])->name('pengelola.transaksi.konfirmasi');
    Route::get('transaksi/selesai', [App\Http\Controllers\Pengelola\TransaksiController::class, 'transaksi_selesai'])->name('pengelola.transaksi.selesai');
});

Route::middleware(['auth','CekLevel:4'])->group(function () {
    Route::get('home', [App\Http\Controllers\User\HomeUserController::class, 'index'])->name('user.dashboard');
    Route::get('/kategori_menu/{id}',[App\Http\Controllers\JenisMenuController::class, 'menuByJenisMenu'])->name('user.kategori.menu');
    Route::post('home',[App\Http\Controllers\User\KeranjangController::class, 'simpan'])->name('user.keranjang.simpan');
    // Route::get('keranjang', [App\Http\Controllers\User\KeranjangController::class, 'index'])->name('user.keranjang');
    Route::resource('keranjang', KeranjangController::class);
    Route::get('/checkout',[App\Http\Controllers\User\CheckoutController::class, 'index'])->name('user.checkout');
    Route::post('keranjang', [App\Http\Controllers\User\OrderController::class, 'simpan'])->name('user.order.simpan');
    Route::get('order', [App\Http\Controllers\User\OrderController::class, 'index'])->name('user.order');
    Route::get('order/detail/{id}',[App\Http\Controllers\User\OrderController::class, 'detail'])->name('user.order.detail');
    Route::get('transaksi', [App\Http\Controllers\User\TransaksiController::class, 'index'])->name('user.transaksi');
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
