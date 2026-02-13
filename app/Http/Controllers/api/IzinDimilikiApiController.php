<?php

namespace App\Http\Controllers\api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Interface\IzinDimilikiInterface;
use Exception;
use Illuminate\Http\Request;

class IzinDimilikiApiController extends Controller
{
     private IzinDimilikiInterface $izinDimilikiInterface;


    public function __construct(IzinDimilikiInterface $izinDimilikiInterface){
        $this->izinDimilikiInterface = $izinDimilikiInterface;
    }

     public function index(Request $request){

         try{
            $izinDimiliki = $this->izinDimilikiInterface->getAll($request->search, $request->limit, true);

            return ResponseHelper::jsonResponse(true, 'Data Izin berhasil diambil', $izinDimiliki, 200);

         }catch(Exception $exception){

            return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);

         }

    }
}
