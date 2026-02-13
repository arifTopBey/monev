<?php

namespace App\Http\Controllers\api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\AgendaResource;
use App\Interface\AgendaInterface;
use Exception;
use Illuminate\Http\Request;

class AgendaApiController extends Controller
{
     private AgendaInterface $monevInterface;


    public function __construct(AgendaInterface $monevInterface){
        $this->monevInterface = $monevInterface;
    }

     public function index(Request $request){

         try{
            $pembinaan = $this->monevInterface->getAll($request->search, $request->limit, true);

            return ResponseHelper::jsonResponse(true, 'Data Agenda berhasil diambil', $pembinaan, 200);

         }catch(Exception $exception){

            return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);

         }

    }

    public function store(Request $request){

        $validated = $request->validate([
            'namaAgenda' => 'required|max:255|string'
        ]);

         try{

            $agenda = $this->monevInterface->create($validated);

            return ResponseHelper::jsonResponse(true, 'Berhasil membuat data Agenda',  new AgendaResource($agenda), 201);

         }catch(Exception $exception){

            return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);

         }
    }
}
