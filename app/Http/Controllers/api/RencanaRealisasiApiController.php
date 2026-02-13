<?php

namespace App\Http\Controllers\api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Interface\RencanaRealisasiInterface;
use Exception;
use Illuminate\Http\Request;

class RencanaRealisasiApiController extends Controller
{
    private RencanaRealisasiInterface $rencanaRealisasiInterface;


    public function __construct(RencanaRealisasiInterface $rencanaRealisasiInterface){
        $this->rencanaRealisasiInterface = $rencanaRealisasiInterface;
    }

     public function index(Request $request){

         try{
            $rencanaRealisasi = $this->rencanaRealisasiInterface->getAll($request->search, $request->limit, true);

            return ResponseHelper::jsonResponse(true, 'Data Rencana Realisasi berhasil diambil', $rencanaRealisasi, 200);

         }catch(Exception $exception){

            return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);

         }

    }
}
