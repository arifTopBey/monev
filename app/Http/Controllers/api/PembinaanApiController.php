<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Helpers\ResponseHelper;
use App\Http\Requests\PembinaanRequest;
use App\Http\Resources\PaginateResource;
use App\Http\Resources\PembinaanResource;
use App\Interface\PembinaanInterface;
use Exception;
use Illuminate\Http\Request;

class PembinaanApiController extends Controller
{

     private PembinaanInterface $pembinaanInterface;


    public function __construct(PembinaanInterface $pembinaanInterface){
        $this->pembinaanInterface = $pembinaanInterface;
    }

     public function index(Request $request){

         try{
            $pembinaan = $this->pembinaanInterface->getAll($request->search, $request->limit, true);

            return ResponseHelper::jsonResponse(true, 'Data Pembinaan berhasil diambil', PembinaanResource::collection($pembinaan), 200);

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

            $pembinaan = $this->pembinaanInterface->getAllPaginate($validated['search']  ?? null, $validated['row_per_page'] ?? 10);

            return ResponseHelper::jsonResponse(true, 'Berhasil mengambil data Pembinaan',   PaginateResource::make($pembinaan, PembinaanResource::class), 200);

         }catch(Exception $exception){

            return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);

         }
    }

    public function store(PembinaanRequest $request){

        $validated = $request->validated();

         try{

            $pembinaan = $this->pembinaanInterface->create($validated);

            return ResponseHelper::jsonResponse(true, 'Berhasil membuat data Pembinaan',  new PembinaanResource($pembinaan), 201);

         }catch(Exception $exception){

            return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);

         }
    }

    public function destroy(int $id){

        try{
            $pembinaan = $this->pembinaanInterface->getById($id);

            // klo engga ketemu idnya
            if(!$pembinaan){
                return ResponseHelper::jsonResponse(false, 'Data Pembinaan Tidak Ditemukan',null, 404);
            }

            $pembinaan = $this->pembinaanInterface->delete($id);
            // jika ada idnya
            return ResponseHelper::jsonResponse(true, 'Data Pembinaan Berhasil dihapus', null, 200);


        }catch(Exception $exception){
            return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);
        }
    }
}
