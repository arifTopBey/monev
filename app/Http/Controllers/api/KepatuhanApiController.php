<?php

namespace App\Http\Controllers\api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Interface\KepatuhanInterface;
use Exception;
use Illuminate\Http\Request;

class KepatuhanApiController extends Controller
{
     private KepatuhanInterface $kepatuhanInterface;


    public function __construct(KepatuhanInterface $kepatuhanInterface){
        $this->kepatuhanInterface = $kepatuhanInterface;
    }

     public function index(Request $request){

         try{
            $kepatuhan = $this->kepatuhanInterface->getAll($request->search, $request->limit, true);

            return ResponseHelper::jsonResponse(true, 'Data Kepatuhan berhasil diambil', $kepatuhan, 200);

         }catch(Exception $exception){

            return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);

         }

    }
}
