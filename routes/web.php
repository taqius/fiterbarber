<?php

use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/pegawai', [App\Http\Controllers\PegawaiController::class, 'index'])->name('pegawai');
// Route::post('/pegawai', [App\Http\Controllers\PegawaiController::class, 'store'])->name('insert pegawai');
// Route::get('/pegawai/create', [App\Http\Controllers\PegawaiController::class, 'create'])->name('tambah');
// Route::get('/pegawai/{pegawai}', [App\Http\Controllers\PegawaiController::class, 'show'])->name('detail');
// Route::delete('/pegawai/{pegawai}', [App\Http\Controllers\PegawaiController::class, 'destroy'])->name('delete');
// Route::get('/pegawai/{pegawai}/edit', [App\Http\Controllers\PegawaiController::class, 'edit'])->name('edit');
// Route::patch('/pegawai/{pegawai}', [App\Http\Controllers\PegawaiController::class, 'update'])->name('update');
// Route di atas tersebut dapat di ganti dengan route dibawah berikut
Route::resource('pegawai', PegawaiController::class);
Route::resource('transaksi', TransaksiController::class);
Route::resource('laporan', LaporanController::class);
Route::resource('keuangan', KeuanganController::class);
Route::get('/searchbulan/{tgl}/{tahun}/{nama}/{ket}', [App\Http\Controllers\LaporanController::class, 'searchbulan'])->name('searchbulan');
Route::get('/searchsaldo/{tgl}/{tahun}', [App\Http\Controllers\KeuanganController::class, 'searchsaldo'])->name('searchsaldo');

Auth::routes();
