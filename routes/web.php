<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/login', [HomeController::class, 'loginview'])->name('indexlogin');
Route::post('/login', [HomeController::class, 'authenticate'])->name('login');
Route::get('/logout', [HomeController::class, 'logout'])->name('logout');


Route::middleware(['web', 'auth.session'])->group(function () {
    Route::get('/profile', [UserController::class, 'showProfile'])->name('profile');
    Route::get('/user', [UserController::class, 'userview'])->name('manajemenuser');
    Route::get('/ubahuser', [UserController::class, 'ubahuser'])->name('ubahuser');
    Route::put('/ubahuser/{id_user}', [UserController::class, 'updateuser'])->name('updateuser');
    Route::get('/tambahuser', [UserController::class, 'tambahuserview'])->name('tambahuserview');
    Route::post('/tambahuser', [UserController::class, 'tambahuser'])->name('tambahuser');
    Route::get('/user/detail/{id_user}', [UserController::class, 'detailuser'])->name('detailuserview');
    Route::get('/user/{id_user}/detailuser', [UserController::class, 'detailtambahview'])->name('tambahdetailuser');
    Route::put('/user/{id_user}/detailuser', [UserController::class, 'tambahDetailUser'])->name('tambahdetail');
    Route::get('/ubahuser/{id_user}', [UserController::class, 'editUser'])->name('ubahuserview');
    Route::get('/hapususer/{id_user}', [UserController::class, 'hapusUser'])->name('hapususer');

    Route::get('/stok-sparepart', [BarangController::class, 'stokbarang'])->name('barang');
    Route::get('/informasi-barang', [BarangController::class, 'informasi'])->name('informasibarang');
    Route::get('/history-pembayaran', [PenjualanController::class, 'history'])->name('historypembayaran');
    Route::get('/ubah-barang/{kd_sparepart}', [BarangController::class, 'ubahbarangview'])->name('ubahbarangview');
    Route::post('/ubah-barang/{kd_sparepart}', [BarangController::class, 'ubahbarang'])->name('ubahbarang');
    Route::get('/hapus-barang/{kd_sparepart}', [BarangController::class, 'hapusbarang'])->name('hapusbarang');
    Route::get('/tambah-barang', [BarangController::class, 'tambahbarangview'])->name('tambahbarangview');
    Route::post('/tambah-barang', [BarangController::class, 'tambahbarang'])->name('tambahbarang');

    Route::get('/data-pelanggan', [PelangganController::class, 'pelanggan'])->name('pelanggan');
    Route::get('/ubah-pelanggan/{id_pelanggan}', [PelangganController::class, 'ubahpelangganview'])->name('ubahpelangganview');
    Route::post('/ubah-pelanggan/{id_pelanggan}', [PelangganController::class, 'ubahpelanggan'])->name('ubahpelanggan');
    Route::get('/hapus-pelanggan/{id_pelanggan}', [PelangganController::class, 'hapuspelanggan'])->name('hapuspelanggan');
    Route::get('/tambah-pelanggan', [PelangganController::class, 'tambahpelangganview'])->name('tambahpelangganview');
    Route::post('/tambah-pelanggan', [PelangganController::class, 'tambahpelanggan'])->name('tambahpelanggan');
    Route::get('/input-pelanggan', [PelangganController::class, 'tambahpelanggankasirview'])->name('tambahpelanggankasirview');
    Route::post('/input-pelanggan', [PelangganController::class, 'tambahpelanggankasir'])->name('tambahpelanggankasir');
    Route::get('/data-penjualan', [PenjualanController::class, 'index'])->name('indexpenjualan');
    Route::get('/tambah-penjualan', [PenjualanController::class, 'create'])->name('tambahpenjualanview');
    Route::post('/tambah-penjualan', [PenjualanController::class, 'store'])->name('tambahpenjualan');

    Route::get('penjualan/{no_nota}/ubah-penjualan', [PenjualanController::class, 'edit'])->name('ubahpenjualan');
    Route::put('penjualan/{no_nota}', [PenjualanController::class, 'update'])->name('prosesubahpenjualan');
    Route::get('/hapuspenjualan/{no_nota}', [PenjualanController::class, 'destroy'])->name('hapuspenjualan');

});



