<?php

namespace App\Http\Controllers;

use App\Interface\PembinaanInterface;
use Illuminate\Http\Request;

class RealisasiPembinaanController extends Controller
{

    private PembinaanInterface $pembinaanInterface;


    public function __construct(PembinaanInterface $pembinaanInterface){
        $this->pembinaanInterface = $pembinaanInterface;
    }


    public function index(Request $request){


        $data = $this->pembinaanInterface->getAllPaginate($request->input('search') ?? null, $request->input('row_per_page') ?? 10);

        return view('admin.realisasi_pembinaan.index', compact('data'));
    }
}
