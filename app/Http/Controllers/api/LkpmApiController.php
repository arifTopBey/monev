<?php

namespace App\Http\Controllers\api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Interface\LkpmInterface;
use Exception;
use Illuminate\Http\Request;

class LkpmApiController extends Controller
{
     private LkpmInterface $lkpmInterface;


    public function __construct(LkpmInterface $kewajibanInterface){
        $this->lkpmInterface = $kewajibanInterface;
    }

     public function index(Request $request){

         try{
            $kepatuhan = $this->lkpmInterface->getAll($request->search, $request->limit, true);

            return ResponseHelper::jsonResponse(true, 'Data LKPM berhasil diambil', $kepatuhan, 200);

         }catch(Exception $exception){

            return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);

         }

    }
}
