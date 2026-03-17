<?php

namespace App\Http\Controllers;

use App\Interface\MonevInterface;
use App\Models\Monev;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

     private MonevInterface $monevInterface;


    public function __construct(MonevInterface $monevInterface){
        $this->monevInterface = $monevInterface;
    }

   public function index(Request $request) {
    $search = $request->input('search');
    $perPage = $request->input('row_per_page', 10);
    
    // 1. Ambil Tahun Terkecil dari Database & Tahun Sekarang untuk Dropdown
    $minYear = Monev::whereNotNull('tanggal_bap')->min(DB::raw('YEAR(tanggal_bap)')) ?? date('year');
    $currentYear = date('Y');
    $availableYears = range($minYear, $currentYear);

    // 2. Ambil Tahun yang dipilih dari Filter (Default: Tahun Sekarang)
    $selectedYear = $request->input('filter_year', $currentYear);

    $filters = [
        'start_date' => $request->input('start_date'),
        'end_date'   => $request->input('end_date'),
    ];

    $data = $this->monevInterface->getAllPaginate($search ?? null, $perPage, $filters);
    $data->appends($request->all());

    // --- Query Chart Horizontal (Total per Tahun) Tetap ---
    $chartData = Monev::selectRaw('YEAR(tanggal_bap) as tahun, count(*) as total')
        ->groupBy('tahun')
        ->orderBy('total', 'desc')
        ->get();
    $year = $chartData->pluck('tahun');
    $total = $chartData->pluck('total');

    // --- Query Investasi 5 Terbesar Tetap ---
    // $investasiData = Monev::select('nama_perusahaan', 'nilai_investasi')->get()
    //     ->map(function ($item) {
    //         $cleanValue = preg_replace('/[^0-9]/', '', $item->nilai_investasi);
    //         $item->nilai_investasi_numeric = (int) $cleanValue;
    //         return $item;
    //     })->sortByDesc('nilai_investasi_numeric')->take(5); 
    $investasiData = Monev::whereYear('tanggal_bap', $selectedYear) 
    ->select('nama_perusahaan', 'nilai_investasi')
    ->get()
    ->map(function ($item) {
        // Pembersihan karakter non-angka karena tipe data varchar
        $cleanValue = preg_replace('/[^0-9]/', '', $item->nilai_investasi);
        $item->nilai_investasi_numeric = (int) $cleanValue;
        return $item;
    })
    ->sortByDesc('nilai_investasi_numeric') 
    ->take(5);

    $perusahaanNames =  $investasiData->pluck('nama_perusahaan');
    $investasiValues =  $investasiData->pluck('nilai_investasi_numeric');

    // --- LOGIKA PIE CHART DENGAN FILTER TAHUN ---
    
    // Buat base query yang difilter tahun agar tidak menulis whereYear berulang-ulang
    $baseMonevQuery = Monev::whereYear('tanggal_bap', $selectedYear);
    $totalMonevFiltered = (clone $baseMonevQuery)->count();

    // 1. PKKPR (Izin Lokasi)
    $sudahLapor = (clone $baseMonevQuery)->whereHas('izinDimiliki', function ($q) {
        $q->where('pkkpr', '1');
    })->count();
    $pieData = [$sudahLapor, $totalMonevFiltered - $sudahLapor];
    $pieLabels = ['Sudah Lapor', 'Belum Lapor'];

    // 2. Izin Lingkungan (IL)
    $sudahLaporLingkungan = (clone $baseMonevQuery)->whereHas('izinDimiliki', function ($q) {
        $q->where('il', '1');
    })->count();
    $pieLingkungan = [$sudahLaporLingkungan, $totalMonevFiltered - $sudahLaporLingkungan];

    // 3. Sertifikat Standar
    $sudahLaporSertifikat = (clone $baseMonevQuery)->whereHas('izinDimiliki', function ($q) {
        $q->where('sertifikat_standar', '1');
    })->count();
    $pieSertifikat = [$sudahLaporSertifikat, $totalMonevFiltered - $sudahLaporSertifikat];

    // 4. LKPM
    $sudahLaporLKPM = (clone $baseMonevQuery)->whereHas('izinLKPM', function ($q) {
        $q->where('statusLapor', '1');
    })->count();
    $pieLKPM = [$sudahLaporLKPM, $totalMonevFiltered - $sudahLaporLKPM];

    $mapData = Monev::select('nama_perusahaan', 'latitude', 'longitude')
        ->whereNotNull('latitude')->whereNotNull('longitude')->get();

    return view("admin.dashboard.index", compact(
        'mapData','data', 'year', 'total', 'perusahaanNames', 'investasiValues', 
        'pieData', 'pieLabels', 'pieLingkungan', 'pieSertifikat', 'pieLKPM', 
        'availableYears', 'selectedYear' // Data baru untuk filter
    ));
}
    public function indexOri(Request $request){

        $search = $request->input('search');

        
        $perPage = $request->input('row_per_page', 10);

         $filters = [
            'start_date' => $request->input('start_date'),
            'end_date'   => $request->input('end_date'),
        ];

        $data = $this->monevInterface->getAllPaginate($search ?? null, $perPage, $filters);
        $data->appends($request->all());

        // Mengambil data jumlah Monev per tahun per tahub
        $chartData = Monev::selectRaw('YEAR(tanggal_bap) as tahun, count(*) as total')
            ->groupBy('tahun')
            ->orderBy('total', 'desc')
            ->get();
        $year = $chartData->pluck('tahun');
        $total = $chartData->pluck('total');
        
        // $investasiData = Monev::select('nama_perusahaan', 'nilai_investasi')
        // ->orderBy('nilai_investasi', 'desc')
        // ->limit(5)
        // ->get();
        $investasiData = Monev::select('nama_perusahaan', 'nilai_investasi')
        ->get()
        ->map(function ($item) {
            // Hapus semua karakter selain angka (titik, koma, Rp, spasi)
            $cleanValue = preg_replace('/[^0-9]/', '', $item->nilai_investasi);
            $item->nilai_investasi_numeric = (int) $cleanValue;
            return $item;
        })
        ->sortByDesc('nilai_investasi_numeric') 
        ->take(5); 
        $perusahaanNames =  $investasiData->pluck('nama_perusahaan');
        $investasiValues =  $investasiData->pluck('nilai_investasi_numeric');

        
        // pkkpr
            $sudahLapor = Monev::whereHas('izinDimiliki', function ($query) {
                $query->where('pkkpr', '1');
            })->count();

        
            $belumLapor = Monev::whereHas('izinDimiliki', function ($query) {
                $query->where('pkkpr', '0')->orWhereNull('pkkpr');
            })->count();
            
        
            $tidakPunyaRecord = Monev::doesntHave('izinDimiliki')->count();
            $totalBelumLapor = $belumLapor + $tidakPunyaRecord;
            
            $pieLabels =  ['Sudah Lapor', 'Belum Lapor'];
            $pieData = [$sudahLapor, $totalBelumLapor];  
        // pkkpr

        // izin lokasi
        // --- Logika Izin Lingkungan (IL) ---
            $totalMonev = Monev::count();
            $sudahLaporLingkungan = Monev::whereHas('izinDimiliki', function ($query) {
                $query->where('il', '1');
            })->count();

            // Sisa dari total data adalah yang belum lapor (termasuk 0 dan null)
            $belumLaporLingkungan = $totalMonev - $sudahLaporLingkungan;

            $pieLingkungan = [$sudahLaporLingkungan, $belumLaporLingkungan];
        // batas izin lokasi

        // izin sertifikat standar
        $sudahLaporSertifikat = Monev::whereHas('izinDimiliki', function ($query) {
            $query->where('sertifikat_standar', '1');
        })->count();

        $belumLaporSertifikat = $totalMonev - $sudahLaporSertifikat;

        $pieSertifikat = [$sudahLaporSertifikat, $belumLaporSertifikat];
        // batas izin sertifikat standar

        // izin lkpm
        $sudahLaporLKPM = Monev::whereHas('izinLKPM', function ($query) {
            $query->where('statusLapor', '1');
        })->count();

        $belumLaporLKPM = $totalMonev - $sudahLaporLKPM;
        $pieLKPM = [$sudahLaporLKPM, $belumLaporLKPM];
        // batas izin lkpm


        // maps data
        $mapData = Monev::select('nama_perusahaan', 'latitude', 'longitude')
        ->whereNotNull('latitude')
        ->whereNotNull('longitude')
        ->get();
        // batas maps data
        return view("admin.dashboard.index", compact('mapData','data', 'year', 'total', 'perusahaanNames', 'investasiValues', 'pieData', 'pieLabels', 'pieLingkungan', 'pieSertifikat', 'pieLKPM'));
    }
}
