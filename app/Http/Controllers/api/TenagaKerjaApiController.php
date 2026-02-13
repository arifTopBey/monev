<?php

namespace App\Http\Controllers\api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Interface\TenagaKerjaInterface;
use Exception;
use Illuminate\Http\Request;

class TenagaKerjaApiController extends Controller
{
     private TenagaKerjaInterface $tenagaKerjaInterface;


    public function __construct(TenagaKerjaInterface $tenagaKerjaInterface){
        $this->tenagaKerjaInterface = $tenagaKerjaInterface;
    }

     public function index(Request $request){

         try{
            $tenagaKerja = $this->tenagaKerjaInterface->getAll($request->search, $request->limit, true);

            return ResponseHelper::jsonResponse(true, 'Data Tenaga Kerja Berhasil Diambil diambil', $tenagaKerja, 200);

         }catch(Exception $exception){

            return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);

         }

    }
}
