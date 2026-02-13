<?php

namespace App\Providers;

use App\Interface\AgendaInterface;
use App\Interface\AuthIterface;
use App\Interface\IzinDimilikiInterface;
use App\Interface\JumlahInvestasiInteface;
use App\Interface\KepatuhanInterface;
use App\Interface\KewajibanInterface;
use App\Interface\LkpmInterface;
use App\Interface\MonevInterface;
use App\Interface\PembinaanInterface;
use App\Interface\RencanaRealisasiInterface;
use App\Interface\StandartProductInterface;
use App\Interface\StandartUsahaInterface;
use App\Interface\TenagaKerjaInterface;
use App\Interface\TimMonitoringInterface;
use App\Repository\MonevRepositoryInterface;
use App\Repository\PembinaanRepositoryInterface;
use App\Repository\AgendaRepositoryInterface;
use App\Repository\AuthRepositoryInterface;
use App\Repository\IzinDimilikiRepositoryInterface;
use App\Repository\JumlahInvestasiRepositoryInterface;
use App\Repository\KepatuhanRepositoryInterface;
use App\Repository\KewajibanRepositoriInterface;
use App\Repository\LkpmRepositoryInterface;
use App\Repository\RencanaRealisasiRepositoryInterface;
use App\Repository\StandartProductRepositoryInterface;
use App\Repository\StandartUsahaRepositoryInterface;
use App\Repository\TenagaKerjaRepositoryInterface;
use App\Repository\TimMonitoringRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(PembinaanInterface::class, PembinaanRepositoryInterface::class);
        $this->app->bind(MonevInterface::class, MonevRepositoryInterface::class);
        $this->app->bind(AgendaInterface::class, AgendaRepositoryInterface::class);
        $this->app->bind(IzinDimilikiInterface::class, IzinDimilikiRepositoryInterface::class);
        $this->app->bind(TenagaKerjaInterface::class, TenagaKerjaRepositoryInterface::class);
        $this->app->bind(JumlahInvestasiInteface::class, JumlahInvestasiRepositoryInterface::class);
        $this->app->bind(KepatuhanInterface::class, KepatuhanRepositoryInterface::class);
        $this->app->bind(KewajibanInterface::class, KewajibanRepositoriInterface::class);
        $this->app->bind(LkpmInterface::class, LkpmRepositoryInterface::class);
        $this->app->bind(StandartProductInterface::class, StandartProductRepositoryInterface::class);
        $this->app->bind(StandartUsahaInterface::class, StandartUsahaRepositoryInterface::class);
        $this->app->bind(RencanaRealisasiInterface::class, RencanaRealisasiRepositoryInterface::class);
        $this->app->bind(TimMonitoringInterface::class, TimMonitoringRepositoryInterface::class);
        $this->app->bind(AuthIterface::class, AuthRepositoryInterface::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
