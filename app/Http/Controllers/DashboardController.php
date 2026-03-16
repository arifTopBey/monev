<?php

namespace App\Http\Controllers;

use App\Interface\MonevInterface;
use App\Models\Monev;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

     private MonevInterface $monevInterface;


    public function __construct(MonevInterface $monevInterface){
        $this->monevInterface = $monevInterface;
    }

    public function index(Request $request){

        $search = $request->input('search');

         // Tangkap input dari form Blade
        $perPage = $request->input('row_per_page', 10);

         $filters = [
            'start_date' => $request->input('start_date'),
            'end_date'   => $request->input('end_date'),
        ];

        $data = $this->monevInterface->getAllPaginate($search ?? null, $perPage, $filters);
        $data->appends($request->all());

        // Mengambil data jumlah Monev per tahun
        $chartData = Monev::selectRaw('YEAR(tanggal_bap) as tahun, count(*) as total')
            ->groupBy('tahun')
            ->orderBy('total', 'desc')
            ->get();
        $year = $chartData->pluck('tahun');
        $total = $chartData->pluck('total');

        return view("admin.dashboard.index", compact('data', 'year', 'total'));
    }
}
