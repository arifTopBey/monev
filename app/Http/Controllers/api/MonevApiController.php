<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\MonevApiStoreRequest;
use App\Http\Resources\MonevResource;
use App\Interface\MonevInterface;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Resources\PaginateResource;
use Exception;

class MonevApiController extends Controller
{
     private MonevInterface $monevInterface;


    public function __construct(MonevInterface $monevInterface){
        $this->monevInterface = $monevInterface;
    }

     public function index(Request $request){

         try{
            $pembinaan = $this->monevInterface->getAll($request->search, $request->limit, true);

            return ResponseHelper::jsonResponse(true, 'Data Money berhasil diambil', $pembinaan, 200);

         }catch(Exception $exception){

            return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);

         }

    }

     public function getAllPaginate(Request $request){

        $validated = $request->validate([
            'search' => 'nullable|string',
            'row_per_page' => 'nullable|integer'
        ]);


         try{

            $monev = $this->monevInterface->getAllPaginate($validated['search']  ?? null, $validated['row_per_page'] ?? 10);

            return ResponseHelper::jsonResponse(true, 'Berhasil mengambil data monev',   PaginateResource::make($monev, MonevResource::class), 200);

         }catch(Exception $exception){

            return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);

         }
    }

    public function store(MonevApiStoreRequest $request){

        $validated = $request->validated();
        try{

            $monev = $this->monevInterface->create($validated);

            return ResponseHelper::jsonResponse(true, 'Berhasil membuat data Monev',  $monev, 201);

         }catch(Exception $exception){

            return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);

         }
    }



}
