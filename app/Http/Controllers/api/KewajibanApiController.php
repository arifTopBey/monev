<?php

namespace App\Http\Controllers\api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Interface\KewajibanInterface;
use Exception;
use Illuminate\Http\Request;

class KewajibanApiController extends Controller
{
     private KewajibanInterface $kewajibanInterface;


    public function __construct(KewajibanInterface $kewajibanInterface){
        $this->kewajibanInterface = $kewajibanInterface;
    }

     public function index(Request $request){

         try{
            $kepatuhan = $this->kewajibanInterface->getAll($request->search, $request->limit, true);

            return ResponseHelper::jsonResponse(true, 'Data Kewajiban berhasil diambil', $kepatuhan, 200);

         }catch(Exception $exception){

            return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);

         }

    }
}
