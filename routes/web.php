<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MonevController;
use App\Http\Controllers\PembinaanController;
use App\Http\Controllers\RealisasiPembinaanController;
use App\Http\Controllers\UserController;
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
    Route::get('/pembinaan/realisasi', [RealisasiPembinaanController::class, 'index'])->name('realisasi.pembinaan.index');
    Route::put('/pembinaan/realisasi/status/{id}', [RealisasiPembinaanController::class, 'updateStatusPembinaan'])->name('realisasi.pembinaan.status.update');


    Route::get('/realisasi', [MonevController::class, 'dataRealisasiMonev'])->name('realisasi');
    Route::put('/realisasi/update-lkpm/{id_bap}',[MonevController::class, 'updateLKPM'])->name('realisasi.update.lkpm');
    Route::put('/realisasi/update-pkkpr/{id_bap}', [MonevController::class, 'updatePKKPR'])->name('realisasi.update.pkkpr');
    Route::put('/realisasi/update-izin-lingkungan/{id_bap}', [MonevController::class, 'izinLingkungan'])->name('realisasi.update.izin.lingkungan');
    Route::put('/realisasi/update-sertifikat-standart/{id_bap}', [MonevController::class, 'updateSertifikatStandart'])->name('realisasi.update.sertifikat.standart');


    Route::get('/monev', [MonevController::class, 'index'])->name('monev');
    Route::get('/monev/detail/{id_bap}',[MonevController::class, 'show'])->name('admin.monev.detail');

    Route::get('/monev/download/{id_bap}', [MonevController::class, 'downloadWord'])->name('admin.monev.download.word');

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


    // gambar private
    Route::get('/storage/private/{path}', [MonevController::class, 'showFoto'])->where('path', '.*')->name('showFoto.private');
    // gambar private

    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

    Route::get('/profile/{id}', [AuthController::class, 'profile'])->name('admin.auth.profile');
    Route::put('/profile-update/{id}', [AuthController::class, 'updateProfile'])->name('admin.auth.profile.update');

    Route::get('/profile/edit-password/{id}', [AuthController::class, 'editPassword'])->name('admin.auth.edit.password');
    Route::put('/profile/update-password/{id}',[AuthController::class, 'updatePassword'])->name('admin.auth.update.password');

    Route::get('/realisasi-pembinaan/export', [RealisasiPembinaanController::class,'export'])->name('realisasi.pembinaan.export');
    Route::get('/monev/export', [MonevController::class,'export'])->name('monev.export');
    Route::get('/pembinaan/export', [MonevController::class,'exportPembinaan'])->name('pembinaan.export');
    Route::get('/dashboard/tki-tka/export', [MonevController::class, 'exportTkiTka'])->name('export.tki.tka');

   Route::middleware(['admin_only'])->group(function(){
        Route::get('/users', [UserController::class, 'index'])->name('super.user.list');
        Route::get('/users/create', [UserController::class, 'create'])->name('super.user.create');
        Route::post('/users/store', [UserController::class, 'store'])->name('super.user.store');
        Route::get('/users/{id}', [UserController::class, 'show'])->name('super.user.detail');
        Route::put('/users/edit/{id}', [UserController::class, 'update'])->name('super.user.update');
        Route::delete('/users/delete/{id}', [UserController::class, 'destroy'])->name('super.user.delete');
   });
    
});


