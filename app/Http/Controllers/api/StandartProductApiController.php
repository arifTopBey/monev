<?php

namespace App\Http\Controllers\api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Interface\StandartProductInterface;
use Exception;
use Illuminate\Http\Request;

class StandartProductApiController extends Controller
{
     private StandartProductInterface $standartProductInterface;


    public function __construct(StandartProductInterface $standartProductInterface){
        $this->standartProductInterface = $standartProductInterface;
    }

     public function index(Request $request){

         try{
            $standartProduct = $this->standartProductInterface->getAll($request->search, $request->limit, true);

            return ResponseHelper::jsonResponse(true, 'Data Pemenuhan Standart Product berhasil diambil', $standartProduct, 200);

         }catch(Exception $exception){

            return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);

         }

    }
}
