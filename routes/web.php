<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PeramalanController;
use App\Http\Controllers\TransaksiKasirController;
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
Route::get('/login', [HomeController::class, 'loginview'])->name('indexlogin')->middleware('bypassauth');
Route::post('/login', [HomeController::class, 'authenticate'])->name('login')->middleware('bypassauth');
Route::get('/logout', [HomeController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserController::class, 'showProfile'])->name('profile');
    Route::get('/user', [UserController::class, 'userview'])->name('manajemenuser')->middleware('role:admin');
    Route::get('/ubahuser', [UserController::class, 'ubahuser'])->name('ubahuser')->middleware('role:admin');
    Route::put('/ubahuser/{id_user}', [UserController::class, 'updateuser'])->name('updateuser')->middleware('role:admin');
    Route::get('/tambahuser', [UserController::class, 'tambahuserview'])->name('tambahuserview')->middleware('role:admin');
    Route::post('/tambahuser', [UserController::class, 'tambahuser'])->name('tambahuser')->middleware('role:admin');
    Route::get('/user/detail/{id_user}', [UserController::class, 'detailuser'])->name('detailuserview')->middleware('role:admin');
    Route::get('/user/{id_user}/detailuser', [UserController::class, 'detailtambahview'])->name('tambahdetailuser')->middleware('role:admin');
    Route::post('/user/{id_user}/detailuser', [UserController::class, 'tambahDetailUser'])->name('tambahdetail')->middleware('role:admin');
    Route::get('/ubahuser/{id_user}', [UserController::class, 'editUser'])->name('ubahuserview')->middleware('role:admin');
    Route::get('/hapususer/{id_user}', [UserController::class, 'hapusUser'])->name('hapususer')->middleware('role:admin');

    Route::get('/stok-sparepart', [BarangController::class, 'stokbarang'])->name('barang')->middleware('role:admin,kasir,manajer');
    Route::get('/informasi-barang', [BarangController::class, 'informasi'])->name('informasibarang')->middleware('role:admin,manajer');
    Route::get('/history-pembayaran', [PenjualanController::class, 'history'])->name('historypembayaran')->middleware('role:admin,manajer');
    Route::get('/ubah-barang/{kd_sparepart}', [BarangController::class, 'ubahbarangview'])->name('ubahbarangview')->middleware('role:admin,manajer,kasir');
    Route::post('/ubah-barang/{kd_sparepart}', [BarangController::class, 'ubahbarang'])->name('ubahbarang')->middleware('role:admin,manajer,kasir');
    Route::get('/tambah-stok/{kd_sparepart}', [BarangController::class, 'tambahstokview'])->name('tambahstokview')->middleware('role:admin,manajer,kasir');
    Route::put('/tambah-stok/{kd_sparepart}', [BarangController::class, 'tambahstok'])->name('tambahstok')->middleware('role:admin,manajer,kasir');
    Route::get('/hapus-barang/{kd_sparepart}', [BarangController::class, 'hapusbarang'])->name('hapusbarang')->middleware('role:admin,manajer,kasir');
    Route::get('/tambah-barang', [BarangController::class, 'tambahbarangview'])->name('tambahbarangview')->middleware('role:admin,manajer,kasir');
    Route::post('/tambah-barang', [BarangController::class, 'tambahbarang'])->name('tambahbarang')->middleware('role:admin,manajer,kasir');

    Route::get('/data-pelanggan', [PelangganController::class, 'pelanggan'])->name('pelanggan')->middleware('role:manajer,admin');
    Route::get('/ubah-pelanggan/{id_pelanggan}', [PelangganController::class, 'ubahpelangganview'])->name('ubahpelangganview')->middleware('role:manajer,admin');
    Route::post('/ubah-pelanggan/{id_pelanggan}', [PelangganController::class, 'ubahpelanggan'])->name('ubahpelanggan')->middleware('role:manajer,admin');
    Route::get('/hapus-pelanggan/{id_pelanggan}', [PelangganController::class, 'hapuspelanggan'])->name('hapuspelanggan')->middleware('role:manajer');
    Route::get('/tambah-pelanggan', [PelangganController::class, 'tambahpelangganview'])->name('tambahpelangganview')->middleware('role:manajer,admin');
    Route::post('/tambah-pelanggan', [PelangganController::class, 'tambahpelanggan'])->name('tambahpelanggan')->middleware('role:manajer,admin');
    Route::get('/input-pelanggan', [PelangganController::class, 'tambahpelanggankasirview'])->name('tambahpelanggankasirview')->middleware('role:kasir');
    Route::post('/input-pelanggan', [PelangganController::class, 'tambahpelanggankasir'])->name('tambahpelanggankasir')->middleware('role:kasir');
    Route::get('/data-penjualan', [PenjualanController::class, 'index'])->name('indexpenjualan')->middleware('role:kasir,manajer');

    Route::get('penjualan/{no_nota}/ubah-penjualan', [PenjualanController::class, 'edit'])->name('ubahpenjualan')->middleware('role:kasir,manajer');
    Route::put('penjualan/{no_nota}', [PenjualanController::class, 'update'])->name('prosesubahpenjualan')->middleware('role:kasir,manajer');
    Route::get('/hapuspenjualan/{no_nota}', [PenjualanController::class, 'destroy'])->name('hapuspenjualan')->middleware('role:kasir,manajer');
    Route::get('/ubah-penjualan/{no_nota}', [PenjualanController::class, 'edit'])->name('ubahpenjualanview')->middleware('role:kasir,manajer');
    Route::put('/ubah-penjualan/{no_nota}', [PenjualanController::class, 'update'])->name('ubahpenjualan')->middleware('role:kasir,manajer');

    Route::get('/transaksi-kasir', [TransaksiKasirController::class, 'transaksikasirview'])->name('transaksikasirview')->middleware('role:kasir');
    Route::post('/transaksi-kasir', [TransaksiKasirController::class, 'transaksikasir'])->name('transaksikasir')->middleware('role:kasir');
    Route::get('/cetak/{no_nota}', [TransaksiKasirController::class,'cetakview'])->name('cetakview')->middleware('role:kasir,manajer');
    Route::get('/cetak-invoice/{no_nota}', [TransaksiKasirController::class,'cetakInvoice'])->name('cetak')->middleware('role:kasir,manajer');

    Route::get('/laporan-keuangan', [LaporanController::class,'laporankeuangan'])->name('laporankeuangan')->middleware('role:akuntan,manajer');
    Route::get('/financial-report/{selectedDate?}', [LaporanController::class, 'generateFinancialReport'])->name('financial-report')->middleware('role:akuntan,manajer');
    Route::get('/peramalanchart', [LaporanController::class, 'peramalan'])->name('peramalan')->middleware('role:akuntan,manajer');
    Route::get('/penjualan-chart', [LaporanController::class, 'penjualanChart'])->name('grafikpenjualan')->middleware('role:akuntan,manajer');
    Route::get('/laporan-pajak', [LaporanController::class,'laporanpajakview'])->name('laporanpajak')->middleware('role:akuntan,manajer');
    Route::get('/get-sales-data/{year}', [LaporanController::class, 'getSalesData']);

    Route::get('/peramalan', [PeramalanController::class, 'index'])->name('peramalan');
    Route::post('/forecast', [PeramalanController::class, 'forecast'])->name('forecast');
});



