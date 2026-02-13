<?php

namespace App\Http\Controllers\api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Interface\TimMonitoringInterface;
use Exception;
use Illuminate\Http\Request;

class TimMonitoringApiController extends Controller
{
     private TimMonitoringInterface $timMonitoringInterface;


    public function __construct(TimMonitoringInterface $timMonitoringInterface){
        $this->timMonitoringInterface = $timMonitoringInterface;
    }

     public function index(Request $request){

         try{
            $timMonitoring = $this->timMonitoringInterface->getAll($request->search, $request->limit, true);

            return ResponseHelper::jsonResponse(true, 'Data Tim Monitoring Diambil diambil', $timMonitoring, 200);

         }catch(Exception $exception){

            return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);

         }

    }
}

