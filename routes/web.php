<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MonevController;
use App\Http\Controllers\PembinaanController;
use App\Http\Controllers\RealiasasiController;
use App\Http\Controllers\RealisasiPembinaanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});






Route::middleware(['guest'])->group(function(){
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
});


Route::middleware(['auth'])->group(function(){

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/pembinaan', [PembinaanController::class, 'index'])->name('pembinaan');
    Route::get('/pembinaan/create', [PembinaanController::class, 'create'])->name('pembinaan.create');
    Route::post('/pembinaan/store', [PembinaanController::class, 'store'])->name('admin.pembinaan.store');
    Route::delete('/pembinaan/delete/{id}', [PembinaanController::class, 'destroy'])->name('admin.pembinaan.destroy');


    Route::get('/realisasi', [RealiasasiController::class, 'index'])->name('realisasi');

    Route::get('/monev', [MonevController::class, 'index'])->name('monev');
    Route::get('/monev/detail/{id_bap}',[MonevController::class, 'show'])->name('admin.monev.detail');

    Route::get('/monev/edit-keterangan-umum/{id_bap}', [MonevController::class, 'showKeteranganUmum'])->name('admin.monev.umum');
    Route::put('/monev/update-keterangan-umum/{id_bap}', [MonevController::class, 'updateKeteranganUmum'])->name('admin.monev.update.umum');

    Route::get('/monev/edit-keterangan-perusahaan/{id_bap}', [MonevController::class, 'showKeteranganPerusahaan'])->name('admin.monev.perusahaan');
    Route::put('/monev/update-keterangan-perusahaan/{id_bap}', [MonevController::class, 'updateKeteranganPerusahaan'])->name('admin.monev.update.keterangan.perusahaan');

    Route::get('/monev/edit-hasil-kesimpulan/{id_bap}', [MonevController::class, 'showHasilKesimpulan'])->name('admin.monev.kesimpulan');
    Route::put('/monev/update-hasil-kesimpulan/{id_bap}', [MonevController::class, 'updateKesimpulan'])->name('admin.monev.update.hasil.kesimpulan');


    Route::get('/monev/edit-foto/{id_bap}', [MonevController::class, 'showHasilFoto'])->name('admin.monev.edit.foto');
    Route::put('/monev/update-foto/{id_bap}', [MonevController::class, 'updateFoto'])->name('admin.monev.update.foto');

    Route::get('/monev/create', [MonevController::class, 'create'])->name('monev.create');
    Route::post('/monev/store', [MonevController::class, 'store'])->name('admin.monev.store');
    Route::delete('/monev/delete/{id_bap}', [MonevController::class, 'destroy'])->name('admin.monev.destroy');

    Route::get('/realisasi-pembinaan', [RealisasiPembinaanController::class, 'index'])->name('realisasi.pembinaan.index');

    // gambar
    Route::get('/storage/private/{path}', [MonevController::class, 'showFoto'])->where('path', '.*')->name('showFoto.private');

    // public function showHasilKesimpulan(){

    //     return view('admin.monev.editKeteranganPerusahaan');
    // }

    // public function showHasilFoto(){
    //     return view('admin.monev.EditFotoLokasi');
    // }


    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

});


