<?php

namespace App\Http\Controllers\api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Interface\JumlahInvestasiInteface;
use Exception;
use Illuminate\Http\Request;

class JumlahInvestasiApiController extends Controller
{
    private JumlahInvestasiInteface $jumlahInvestasiInteface;


    public function __construct(JumlahInvestasiInteface $jumlahInvestasiInteface){
        $this->jumlahInvestasiInteface = $jumlahInvestasiInteface;
    }

     public function index(Request $request){

         try{
            $jumlahInvestasi = $this->jumlahInvestasiInteface->getAll($request->search, $request->limit, true);

            return ResponseHelper::jsonResponse(true, 'Data Jumlah Investasi berhasil diambil', $jumlahInvestasi, 200);

         }catch(Exception $exception){

            return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);

         }

    }
}
