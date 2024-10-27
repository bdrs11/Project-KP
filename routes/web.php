<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GoodsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReportSaleController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SupplierController;
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

Route::get('/', function () {
    return view('landing'); //welcome
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/daftar_barang', [BarangController::class, 'index'])->name('daftar_barang');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/koperasi/admin/kelola_barang', [GoodsController::class, 'index'])->name('koperasi.admin.kelola_barang');
Route::get('/koperasi/admin/kelola_barang/create', [GoodsController::class, 'create'])->name('koperasi.admin.kelola_barang.create');
Route::post('/koperasi/admin/kelola_barang', [GoodsController::class, 'store'])->name('koperasi.admin.kelola_barang.store');
Route::get('/koperasi/admin/kelola_barang/{id}/edit', [GoodsController::class, 'edit'])->name('koperasi.admin.kelola_barang.edit');
Route::match(['put', 'patch'],'/koperasi/admin/kelola_barang/{id}', [GoodsController::class, 'update'])->name('koperasi.admin.kelola_barang.update');
Route::delete('/koperasi/admin/kelola_barang/{id}', [GoodsController::class, 'destroy'])->name('koperasi.admin.kelola_barang.destroy');

Route::get('/koperasi/admin/kelola_stock', [StockController::class, 'index'])->name('koperasi.admin.kelola_stock');
Route::get('/koperasi/admin/kelola_stock/{id}/edit', [StockController::class, 'edit'])->name('koperasi.admin.kelola_stock.edit');
Route::match(['put', 'patch'],'/koperasi/admin/kelola_stock/{id}', [StockController::class, 'update'])->name('koperasi.admin.kelola_stock.update');

Route::get('/koperasi/admin/laporan_keuangan', [ReportSaleController::class, 'index'])->name('koperasi.admin.laporan_keuangan');
Route::get('/koperasi/admin/laporan_keuangan/pdf', [ReportSaleController::class, 'cetakPDF'])->name('koperasi.admin.laporan_keuangan.pdf');

Route::get('/koperasi/admin/penjualan', [SaleController::class, 'index'])->name('koperasi.admin.penjualan');
Route::get('/koperasi/admin/penjualan/create', [SaleController::class, 'create'])->name('koperasi.admin.penjualan.create');
Route::post('/koperasi/admin/penjualan', [SaleController::class, 'store'])->name('koperasi.admin.penjualan.store');
Route::get('/koperasi/admin/penjualan/struk/{id}', [SaleController::class, 'printStruk'])->name('koperasi.admin.penjualan.struk');
Route::delete('/koperasi/admin/penjualan/{id}', [SaleController::class, 'destroy'])->name('koperasi.admin.penjualan.destroy');

Route::get('/koperasi/admin/suppliers', [SupplierController::class, 'index'])->name('koperasi.admin.suppliers');
Route::get('/koperasi/admin/suppliers/create', [SupplierController::class, 'create'])->name('koperasi.admin.suppliers.create');
Route::post('/koperasi/admin/suppliers', [SupplierController::class, 'store'])->name('koperasi.admin.suppliers.store');
Route::get('/koperasi/admin/suppliers/{id}/edit', [SupplierController::class, 'edit'])->name('koperasi.admin.suppliers.edit');
Route::match(['put', 'patch'],'/koperasi/admin/suppliers/{id}', [SupplierController::class, 'update'])->name('koperasi.admin.suppliers.update');
Route::delete('/koperasi/admin/suppliers/{id}', [SupplierController::class, 'destroy'])->name('koperasi.admin.suppliers.destroy');

Route::get('/koperasi/pengguna/anggota', [UserController::class, 'index'])->name('koperasi.pengguna.anggota');
Route::get('/koperasi/pengguna/anggota/create', [UserController::class, 'create'])->name('koperasi.pengguna.anggota.create');
Route::post('/koperasi/pengguna/anggota', [UserController::class, 'store'])->name('koperasi.pengguna.anggota.store');
Route::get('/koperasi/pengguna/anggota/{id}/edit', [UserController::class, 'edit'])->name('koperasi.pengguna.anggota.edit');
Route::match(['put', 'patch'],'/koperasi/pengguna/anggota/{id}', [UserController::class, 'update'])->name('koperasi.pengguna.anggota.update');
Route::delete('/koperasi/pengguna/anggota/{id}', [UserController::class, 'destroy'])->name('koperasi.pengguna.anggota.destroy');

Route::get('/koperasi/pengguna/laporan', [ReportController::class, 'index'])->name('koperasi.pengguna.laporan');
Route::get('/koperasi/pengguna/laporan/pdf', [ReportController::class, 'cetakPDF'])->name('koperasi.pengguna.laporan.pdf');

require __DIR__.'/auth.php';
