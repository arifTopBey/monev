<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\MonevApiStoreRequest;
use App\Http\Resources\MonevResource;
use App\Interface\MonevInterface;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Requests\api\UpdateKeteranganPerusahaanRequest;
use App\Http\Requests\api\UpdateMonevUmumRequest;
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

    public function show($id_bap){

        try{

            $monev = $this->monevInterface->getById($id_bap);
            if(!$monev){
                return ResponseHelper::jsonResponse(false, 'Data Monev tidak ditemukan', null, 404);
            }

            return ResponseHelper::jsonResponse(true, 'Berhasil mengambil data Monev',  $monev, 200);

         }catch(Exception $exception){

            return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);

         }
    }

    public function showKeteranganUmum($id_bap){

        try{

            $monev = $this->monevInterface->getById($id_bap);
            if(!$monev){
                return ResponseHelper::jsonResponse(false, 'Data Monev tidak ditemukan', null, 404);
            }

            return ResponseHelper::jsonResponse(true, 'Berhasil mengambil data Keterangan Umum',  $monev->keterangan_umum, 200);

         }catch(Exception $exception){

            return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);

         }  
    }

    public function updateKeteranganUmum(UpdateMonevUmumRequest $request, $id_bap){

        $validated = $request->validated();

        try{

            $monev = $this->monevInterface->updateUmum($id_bap, $validated);

            return ResponseHelper::jsonResponse(true, 'Berhasil memperbarui Keterangan Umum',  $monev, 200);

         }catch(Exception $exception){

            return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);

         }
    }

    public function showKeteranganPerusahaan($id_bap){

        try{

            $monev = $this->monevInterface->getById($id_bap);
            if(!$monev){
                return ResponseHelper::jsonResponse(false, 'Data Monev tidak ditemukan', null, 404);
            }

            return ResponseHelper::jsonResponse(true, 'Berhasil mengambil data Keterangan Perusahaan',  $monev->keterangan_perusahaan, 200);

         }catch(Exception $exception){

            return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);

         }
    }

    public function updateKeteranganPerusahaan(UpdateKeteranganPerusahaanRequest $request, $id_bap){

        $validated = $request->validated();

        try{

            $monev = $this->monevInterface->updateKeteranganPerusahaan($id_bap, $validated);

            return ResponseHelper::jsonResponse(true, 'Berhasil memperbarui Keterangan Perusahaan',  $monev, 200);

         }catch(Exception $exception){

            return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);

         }
    }

    public function showHasilKesimpulan($id_bap){

        try{

            $monev = $this->monevInterface->getById($id_bap);
            if(!$monev){
                return ResponseHelper::jsonResponse(false, 'Data Monev tidak ditemukan', null, 404);
            }

            return ResponseHelper::jsonResponse(true, 'Berhasil mengambil data Hasil Kesimpulan',  $monev->hasil_kesimpulan, 200);

         }catch(Exception $exception){

            return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);

         }
    }

    public function updateHasilKesimpulan(UpdateMonevUmumRequest $request, $id_bap){

        $validated = $request->validated();

        try{

            $monev = $this->monevInterface->updateHasilKesimpulan($id_bap, $validated);

            return ResponseHelper::jsonResponse(true, 'Berhasil memperbarui Hasil Kesimpulan',  $monev, 200);

         }catch(Exception $exception){

            return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);

         }
    }



}
