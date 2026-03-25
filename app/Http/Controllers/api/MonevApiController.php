<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\MonevApiStoreRequest;
use App\Http\Resources\MonevResource;
use App\Interface\MonevInterface;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Requests\api\MonevUpdateFotoApiRequest;
use App\Http\Requests\api\UpdateKesimpulanRequest;
use App\Http\Requests\api\UpdateKeteranganPerusahaanRequest;
use App\Http\Requests\api\UpdateMonevUmumRequest;
use App\Http\Resources\PaginateResource;
use Exception;
use Illuminate\Support\Facades\Storage;

class MonevApiController extends Controller
{
     private MonevInterface $monevInterface;


    public function __construct(MonevInterface $monevInterface){
        $this->monevInterface = $monevInterface;
    }

     public function index(Request $request){

         try{
            $monev = $this->monevInterface->getAll($request->search, $request->limit, true);
            // $monev->foto_lapangan_url = $monev->foto_lapangan ? url('api/v1/foto/' . $monev->foto_lapangan) : null;
            // $monev->foto_lapangan2_url = $monev->foto_lapangan2 ? url('api/v1/foto/' . $monev->foto_lapangan2) : null;
            // $monev->foto_lapangan2_url = $monev->foto_lapangan2 ? url('api/v1/foto/' . $monev->foto_lapangan3) : null;

             foreach ($monev as $item) {

                    $item->foto_lapangan_url = $item->foto_lapangan
                        ? url('api/v1/foto/' . $item->foto_lapangan)
                        : null;

                    $item->foto_lapangan2_url = $item->foto_lapangan2
                        ? url('api/v1/foto/' . $item->foto_lapangan2)
                        : null;

                    $item->foto_lapangan3_url = $item->foto_lapangan3
                        ? url('api/v1/foto/' . $item->foto_lapangan3)
                        : null;
                }

            return ResponseHelper::jsonResponse(true, 'Data Money berhasil diambil', MonevResource::collection($monev), 200);

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

             foreach ($monev as $item) {

                    $item->foto_lapangan_url = $item->foto_lapangan
                        ? url('api/v1/foto/' . $item->foto_lapangan)
                        : null;

                    $item->foto_lapangan2_url = $item->foto_lapangan2
                        ? url('api/v1/foto/' . $item->foto_lapangan2)
                        : null;

                    $item->foto_lapangan3_url = $item->foto_lapangan3
                        ? url('api/v1/foto/' . $item->foto_lapangan3)
                        : null;
                }
           
            return ResponseHelper::jsonResponse(true, 'Berhasil mengambil data monev',   PaginateResource::make($monev, MonevResource::class), 200);

         }catch(Exception $exception){

            return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);

         }
    }

    public function store(MonevApiStoreRequest $request){

        $validated = $request->validated();
        try{

            $monev = $this->monevInterface->create($validated);

            return ResponseHelper::jsonResponse(true, 'Berhasil membuat data Monev',  new MonevResource($monev), 201);

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

            // Tambahkan URL akses ke properti objek
            // Kita gunakan helper url() untuk membuat link lengkap
            $monev->foto_lapangan_url = $monev->foto_lapangan ? url('api/v1/foto/' . $monev->foto_lapangan) : null;
            $monev->foto_lapangan2_url = $monev->foto_lapangan2 ? url('api/v1/foto/' . $monev->foto_lapangan2) : null;
            $monev->foto_lapangan3_url = $monev->foto_lapangan3 ? url('api/v1/foto/' . $monev->foto_lapangan3) : null;

            return ResponseHelper::jsonResponse(true, 'Berhasil mengambil data Monev',  new MonevResource($monev), 200);

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

            return ResponseHelper::jsonResponse(true, 'Berhasil mengambil data Keterangan Umum',  new MonevResource($monev), 200);

         }catch(Exception $exception){

            return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);

         }
    }

    public function updateKeteranganUmum(UpdateMonevUmumRequest $request, $id_bap){

        $validated = $request->validated();

        try{

            $monev = $this->monevInterface->updateUmum($id_bap, $validated);

            return ResponseHelper::jsonResponse(true, 'Berhasil memperbarui Keterangan Umum',  new MonevResource($monev), 200);

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

            return ResponseHelper::jsonResponse(true, 'Berhasil mengambil data Keterangan Perusahaan',  new MonevResource($monev), 200);

         }catch(Exception $exception){

            return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);

         }
    }

    public function updateKeteranganPerusahaan(UpdateKeteranganPerusahaanRequest $request, $id_bap){

        $validated = $request->validated();

        try{

            $monev = $this->monevInterface->getById($id_bap);
            if(!$monev){
                return ResponseHelper::jsonResponse(false, 'Data Monev tidak ditemukan', null, 404);
            }

            $monev = $this->monevInterface->updateKeteranganPerusahaan($id_bap, $validated);

            return ResponseHelper::jsonResponse(true, 'Berhasil memperbarui Keterangan Perusahaan',  new MonevResource($monev), 200);

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

            return ResponseHelper::jsonResponse(true, 'Berhasil mengambil data Hasil Kesimpulan',  new MonevResource($monev), 200);

         }catch(Exception $exception){

            return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);

         }
    }

    public function updateHasilKesimpulan(UpdateKesimpulanRequest $request, $id_bap){

        $validated = $request->validated();

        try{

             $monev = $this->monevInterface->getById($id_bap);
            if(!$monev){
                return ResponseHelper::jsonResponse(false, 'Data Monev tidak ditemukan', null, 404);
            }

            $monev = $this->monevInterface->updateHasilKesimpulan($id_bap, $validated);

            return ResponseHelper::jsonResponse(true, 'Berhasil memperbarui Hasil Kesimpulan',  new MonevResource($monev), 200);

         }catch(Exception $exception){

            return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);

         }
    }

    public function showEditFoto($id_bap){

         try{

            $monev = $this->monevInterface->getById($id_bap);
            if(!$monev){
                return ResponseHelper::jsonResponse(false, 'Data Monev tidak ditemukan', null, 404);
            }
            $monev->foto_lapangan_url = $monev->foto_lapangan ? url('api/v1/foto/' . $monev->foto_lapangan) : null;
            $monev->foto_lapangan2_url = $monev->foto_lapangan2 ? url('api/v1/foto/' . $monev->foto_lapangan2) : null;
            $monev->foto_lapangan2_url = $monev->foto_lapangan2 ? url('api/v1/foto/' . $monev->foto_lapangan3) : null;

            return ResponseHelper::jsonResponse(true, 'Berhasil mengambil data Hasil Kesimpulan',  new MonevResource($monev), 200);

         }catch(Exception $exception){

            return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);

         }
    }

    public function updateFoto(MonevUpdateFotoApiRequest $request, $id_bap){

        $validated = $request->validated();

         try {

            $monev = $this->monevInterface->getById($id_bap);
            if(!$monev){
                return ResponseHelper::jsonResponse(false, 'Data Monev tidak ditemukan', null, 404);
            }

            $monev = $this->monevInterface->updateFoto($id_bap, $validated);
            $monev->foto_lapangan_url = $monev->foto_lapangan ? url('api/v1/foto/' . $monev->foto_lapangan) : null;
            $monev->foto_lapangan2_url = $monev->foto_lapangan2 ? url('api/v1/foto/' . $monev->foto_lapangan2) : null;
            $monev->foto_lapangan2_url = $monev->foto_lapangan2 ? url('api/v1/foto/' . $monev->foto_lapangan3) : null;

            return ResponseHelper::jsonResponse(true, 'Berhasil memperbarui foto', new MonevResource($monev), 200);

         }catch(Exception $exception){

            return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);

         }

    }

     public function destroy(int $id){

        try{
            $pembinaan = $this->monevInterface->getById($id);

            // klo engga ketemu idnya
            if(!$pembinaan){
                return ResponseHelper::jsonResponse(false, 'Data Monev Tidak Ditemukan',null, 404);
            }

            $pembinaan = $this->monevInterface->delete($id);
            // jika ada idnya
            return ResponseHelper::jsonResponse(true, 'Data Monev Berhasil dihapus', null, 200);


        }catch(Exception $exception){
            return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);
        }
    }

    public function photoApi($filename){
        // if (!Storage::disk('local')->exists($path)) {
        //     return response()->json(['message' => 'File tidak ditemukan'], 404);
        // }
        // return Storage::disk('local')->response($path);
        //  $path = 'uploads/' . $filename;

        // if (!Storage::disk('local')->exists($path)) {
        //     return response()->json(['message' => 'File tidak ditemukan'], 404);
        // }

        // return Storage::disk('local')->response($path);

        $path = 'uploads/' . $filename;

        return [
            'filename' => $filename,
            'path' => $path,
            'exists' => Storage::disk('local')->exists($path)
        ];
    }

    public function updateLKPM($id){

         try{
            $monev = $this->monevInterface->getById($id);

            // klo engga ketemu idnya
            if(!$monev){
                return ResponseHelper::jsonResponse(false, 'Data Monev Tidak Ditemukan',null, 404);
            }

            $monev = $this->monevInterface->updateLKPM($id);
            // jika ada idnya
            return ResponseHelper::jsonResponse(true, 'Data Status Izin LKPM monev Berhasil diupdate', new MonevResource($monev), 200);


        }catch(Exception $exception){
            return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);
        }
    }

    public function updatePKKPR($id){

        try{
            $monev = $this->monevInterface->getById($id);

            // klo engga ketemu idnya
            if(!$monev){
                return ResponseHelper::jsonResponse(false, 'Data Monev Tidak Ditemukan',null, 404);
            }

            $monev = $this->monevInterface->updatePKKPR($id);
            // jika ada idnya
            return ResponseHelper::jsonResponse(true, 'Data Status Izin PKKPR/Lokasi monev Berhasil diupdate', new MonevResource($monev), 200);


        }catch(Exception $exception){
            return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);
        }

    }

    public function updateIzinLingungan($id){

         try{
            $monev = $this->monevInterface->getById($id);

            // klo engga ketemu idnya
            if(!$monev){
                return ResponseHelper::jsonResponse(false, 'Data Monev Tidak Ditemukan',null, 404);
            }

            $monev = $this->monevInterface->updateIzinLingungan($id);
            // jika ada idnya
            return ResponseHelper::jsonResponse(true, 'Data Status Izin Lingkungan monev Berhasil diupdate', new MonevResource($monev), 200);


        }catch(Exception $exception){
            return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);
        }
    }

    public function updateSertifikatStandart($id){

        try{
            $monev = $this->monevInterface->getById($id);

            // klo engga ketemu idnya
            if(!$monev){
                return ResponseHelper::jsonResponse(false, 'Data Monev Tidak Ditemukan',null, 404);
            }

            $monev = $this->monevInterface->updateSertifikatStandart($id);
            // jika ada idnya
            return ResponseHelper::jsonResponse(true, 'Data Status Izin Sertifikat Standart monev Berhasil diupdate', new MonevResource($monev), 200);


        }catch(Exception $exception){
            return ResponseHelper::jsonResponse(false, $exception->getMessage(), null, 500);
        }
    }


    // public function updateHasilKesimpulan(UpdateKesimpulanRequest $request, $id){

    // }



}
