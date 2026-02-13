<?php

namespace App\Http\Controllers\api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Interface\StandartUsahaInterface;
use Exception;
use Illuminate\Http\Request;

class StandartUsahaApiController extends Controller
{
      private StandartUsahaInterface $standartProductUsahaInterface;


    public function __construct(StandartUsahaInterface $standartProductUsahaInterface){
        $this->standartProductUsahaInterface = $standartProductUsahaInterface;
    }

     public function index(Request $request){

         try{
            $standartUsaha = $this->standartProductUsahaInterface->getAll($request->search, $request->limit, true);

            return ResponseHelper::jsonResponse(true, 'Data Pemenuhan Standart Usaha berhasil diambil', $standartUsaha, 200);

         }catch(Exception $exception){

            return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);

         }

    }
}
