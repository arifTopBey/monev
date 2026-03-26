<?php

use App\Http\Controllers\api\JumlahInvestasiApiController;
use App\Http\Controllers\api\MonevApiController;
use App\Http\Controllers\api\PembinaanApiController;
use App\Http\Controllers\api\AgendaApiController;
use App\Http\Controllers\api\AuthApiController;
use App\Http\Controllers\api\IzinDimilikiApiController;
use App\Http\Controllers\api\KepatuhanApiController;
use App\Http\Controllers\api\KewajibanApiController;
use App\Http\Controllers\api\LkpmApiController;
use App\Http\Controllers\api\RencanaRealisasiApiController;
use App\Http\Controllers\api\StandartProductApiController;
use App\Http\Controllers\api\StandartUsahaApiController;
use App\Http\Controllers\api\TenagaKerjaApiController;
use App\Http\Controllers\api\TimMonitoringApiController;
use App\Http\Controllers\api\UserApiController;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::middleware(['guest'])->group(function(){
    Route::post('/login', [AuthApiController::class, 'login'])->name('api.login.store');
});




Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('/pembinaan', [PembinaanApiController::class, 'index'])->name('api.pembinaan.list');
    Route::get('/pembinaan/paginasi', [PembinaanApiController::class, 'getAllPaginate'])->name('api.pembinaan.paginasi');

    Route::post('/pembinaan/create', [PembinaanApiController::class, 'store'])->name('api.pembinaan.store');
    Route::delete('/pembinaan/{id}', [PembinaanApiController::class, 'destroy'])->name('api.pembinaan.destroy');

    Route::put('/pembinaan/realisasi/{id}', [PembinaanApiController::class, 'updateStatusPembinaan'])->name('api.pembinaan.realisasi.status.update');

    Route::get('/monev', [MonevApiController::class, 'index'])->name('api.monev.list');
    Route::post('/monev/create', [MonevApiController::class, 'store'])->name('api.monev.store');
    Route::get('/monev/paginasi', [MonevApiController::class, 'getAllPaginate'])->name('api.monev.paginate');
    Route::get('/monev/{id_bap}', [MonevApiController::class, 'show'])->name('api.monev.show');

    Route::put('/monev/realisasi-lkpm/{id}', [MonevApiController::class, 'updateLKPM'])->name('api.monev.realisasi.update.lkpm');
    Route::put('/monev/realisasi-lokasi/{id}', [MonevApiController::class, 'updatePKKPR'])->name('api.monev.realisasi.update.pkkpr');
    Route::put('/monev/realisasi-lingkungan/{id}', [MonevApiController::class, 'updateIzinLingungan'])->name('api.monev.realisasi.update.lingkungan');
    Route::put('/monev/realisasi-sertifikat-standart/{id}', [MonevApiController::class, 'updateSertifikatStandart'])->name('api.monev.realisasi.update.sertifikat.standart');
    

    Route::get('/monev/edit-keterangan-umum/{id_bap}', [MonevApiController::class, 'showKeteranganUmum'])->name('api.monev.umum');
    Route::put('/monev/update-keterangan-umum/{id_bap}', [MonevApiController::class, 'updateKeteranganUmum'])->name('api.monev.update.umum');

    Route::get('/monev/edit-keterangan-perusahaan/{id_bap}', [MonevApiController::class, 'showKeteranganPerusahaan'])->name('api.monev.perusahaan');
    Route::put('/monev/update-keterangan-perusahaan/{id_bap}', [MonevApiController::class, 'updateKeteranganPerusahaan'])->name('api.monev.update.keterangan.perusahaan');

    Route::get('/monev/edit-hasil-kesimpulan/{id_bap}', [MonevApiController::class, 'showHasilKesimpulan'])->name('api.monev.kesimpulan');
    Route::put('/monev/update-hasil-kesimpulan/{id_bap}', [MonevApiController::class, 'updateHasilKesimpulan'])->name('api.monev.update.hasil.kesimpulan');

    Route::get('/monev/edit-foto/{id_bap}', [MonevApiController::class, 'showEditFoto'])->name('api.monev.foto');
    Route::put('/monev/update-foto/{id_bap}', [MonevApiController::class, 'updateFoto'])->name('api.monev.update.foto');

    Route::delete('/monev/delete/{id_bap}', [MonevApiController::class, 'destroy'])->name('api.monev.destroy');

    // foto private
    Route::get('/v1/foto/{filename}',[MonevApiController::class, 'photoApi'])->where('path', '.*');
    // batas foto private

    Route::get('/agenda', [AgendaApiController::class, 'index'])->name('api.agenda.list');
    Route::post('/agenda/create', [AgendaApiController::class, 'store'])->name('api.agenda.create');
    Route::get('/izin-dimiliki', [IzinDimilikiApiController::class, 'index'])->name('api.izin.dimiliki.index');

    Route::get('/tenaga-kerja', [TenagaKerjaApiController::class, 'index'])->name('api.tenaga.kerja.list');
    Route::get('/jumlah-investasi', [JumlahInvestasiApiController::class, 'index'])->name('api.jumlah.investasi.list');

    Route::get('/kepatuhan', [KepatuhanApiController::class, 'index'])->name('api.kepatuhan.index');
    Route::get('/kewajiban', [KewajibanApiController::class, 'index'])->name('api.kewajiban.list');
    Route::get('/lkpm', [LkpmApiController::class, 'index'])->name('api.lkpm.list');
    Route::get('/pemenuhan-standart-product', [StandartProductApiController::class, 'index'])->name('api.pemenuhan.standart.product.list');
    Route::get('/pemenuhan-standart-usaha', [StandartUsahaApiController::class, 'index'])->name('api.pemenuhan.standart.usaha.list');

    Route::get('/rencana-realisasi', [RencanaRealisasiApiController::class, 'index'])->name('api.rencana.realisasi.list');
    Route::get('/tim-monitoring', [TimMonitoringApiController::class, 'index'])->name('api.tim.monitoring.list');

    Route::post('/logout', [AuthApiController::class, 'logout'])->name('api.auth.logout');
    
     Route::middleware(['admin_only'])->group(function(){
        Route::get('/users', [UserApiController::class, 'index'])->name('api.super.user.list');
        Route::post('/users/store', [UserApiController::class, 'store'])->name('api.super.user.store');
        Route::get('/users/{id}', [UserApiController::class, 'show'])->name('api.super.user.detail');
        Route::put('/users/edit/{id}', [UserApiController::class, 'update'])->name('api.super.user.update');
        Route::delete('/users/delete/{id}', [UserApiController::class, 'destroy'])->name('api.super.user.delete');
   });
});
