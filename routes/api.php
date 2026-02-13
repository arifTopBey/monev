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
use Illuminate\Http\Request;
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


    Route::get('/monev', [MonevApiController::class, 'index'])->name('monev.list');
    Route::get('/monev/paginasi', [MonevApiController::class, 'getAllPaginate'])->name('api.monev.paginate');


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
});
