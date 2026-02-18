<?php

namespace App\Http\Controllers;

use App\Http\Requests\api\MonevApiStoreRequest;
use App\Http\Requests\api\MonevUpdateFotoApiRequest;
use App\Http\Requests\api\UpdateKesimpulanRequest;
use App\Http\Requests\api\UpdateKeteranganPerusahaanRequest;
use App\Http\Requests\api\UpdateMonevUmumRequest;
use App\Interface\MonevInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MonevController extends Controller
{

    private MonevInterface $monevInterface;


    public function __construct(MonevInterface $monevInterface){
        $this->monevInterface = $monevInterface;
    }

    public function index(Request $request){
         $search = $request->input('search');

         // Tangkap input dari form Blade
        $perPage = $request->input('row_per_page', 10);

         $filters = [
            'start_date' => $request->input('start_date'),
            'end_date'   => $request->input('end_date'),
        ];

        $data = $this->monevInterface->getAllPaginate($search ?? null, $perPage, $filters);
        $data->appends($request->all());


        return view('admin.monev.index', compact('data'));
    }

    public function dataRealisasiMonev(Request $request){

         $search = $request->input('search');

         // Tangkap input dari form Blade
        $perPage = $request->input('row_per_page', 10);

         $filters = [
            'start_date' => $request->input('start_date'),
            'end_date'   => $request->input('end_date'),
        ];

        $data = $this->monevInterface->getAllPaginate($search ?? null, $perPage, $filters);
        $data->appends($request->all());


        return view('admin.realisasi.index', compact('data'));

    }

    public function create(){

        return view('admin.monev.create');
    }


    public function store(MonevApiStoreRequest $request){

        $validated = $request->validated();
         try{

            $monev = $this->monevInterface->create($validated);

            return redirect()->route('monev')->with('success', 'Data berhasil ditambah');

         }catch(Exception $exception){
                return back()->withErrors(['error' => 'Gagal menyimpan data: ' . $exception->getMessage()]);
         }

    }

    public function show($id_bap){

            $monev = $this->monevInterface->getById($id_bap);

             if(!$monev){
                return redirect()->route('monev')->withErrors(['error' => 'Data tidak ditemukan']);
             }


        return view('admin.monev.detail', compact('monev'));
    }


    #nanti pake id
    public function showKeteranganUmum($id_bap){

      $monev = $this->monevInterface->getById($id_bap);

        if(!$monev){
            return redirect()->route('monev')->withErrors(['error' => 'Data tidak ditemukan']);
        }


        return view('admin.monev.editKeteranganUmum', compact('monev'));
    }

    public function updateKeteranganUmum(UpdateMonevUmumRequest $request, $id_bap){

        $validated = $request->validated();

        try{

            $monev = $this->monevInterface->getById($id_bap);

            if(!$monev){
                return redirect()->route('admin.monev.detail', ['id_bap' => $id_bap])->withErrors(['error' => 'Data tidak ditemukan']);
            }

            $this->monevInterface->updateUmum($id_bap, $validated);

            return redirect()->route('admin.monev.detail', ['id_bap' => $id_bap])->with('success', 'Data berhasil diperbarui');

         }catch(Exception $exception){
                return back()->withErrors(['error' => 'Gagal memperbarui data: ' . $exception->getMessage()]);
         }
    }

    public function showKeteranganPerusahaan($id_bap){

        $monev = $this->monevInterface->getById($id_bap);

        if(!$monev){
            return redirect()->route('monev')->withErrors(['error' => 'Data tidak ditemukan']);
        }

        return view('admin.monev.editKeteranganPerusahaan', compact('monev'));
    }

    public function updateKeteranganPerusahaan(UpdateKeteranganPerusahaanRequest $request, $id_bap){

        $validated = $request->validated();

        try{

            $monev = $this->monevInterface->getById($id_bap);

            if(!$monev){
                return redirect()->route('admin.monev.detail', ['id_bap' => $id_bap])->withErrors(['error' => 'Data tidak ditemukan']);
            }

            $this->monevInterface->updateKeteranganPerusahaan($id_bap, $validated);

            return redirect()->route('admin.monev.detail', ['id_bap' => $id_bap])->with('success', 'Data berhasil diperbarui');

         }catch(Exception $exception){
                return back()->withErrors(['error' => 'Gagal memperbarui data: ' . $exception->getMessage()]);
         }

    }

    public function showHasilKesimpulan($id_bap){

         $monev = $this->monevInterface->getById($id_bap);

        if(!$monev){
            return redirect()->route('monev')->withErrors(['error' => 'Data tidak ditemukan']);
        }

        return view('admin.monev.editKesimpulan', compact('monev'));
    }

    public function updateKesimpulan(UpdateKesimpulanRequest $request, $id_bap){

        $validated = $request->validated();

        try{

            $monev = $this->monevInterface->getById($id_bap);

            if(!$monev){
                return redirect()->route('admin.monev.detail', ['id_bap' => $id_bap])->withErrors(['error' => 'Data tidak ditemukan']);
            }

            $this->monevInterface->updateHasilKesimpulan($id_bap, $validated);

            return redirect()->route('admin.monev.detail', ['id_bap' => $id_bap])->with('success', 'Data berhasil diperbarui');

         }catch(Exception $exception){
                return back()->withErrors(['error' => 'Gagal memperbarui data: ' . $exception->getMessage()]);
         }

    }



    public function showHasilFoto($id_bap){

        $monev = $this->monevInterface->getById($id_bap);

        if(!$monev){
            return redirect()->route('monev')->withErrors(['error' => 'Data tidak ditemukan']);
        }

        return view('admin.monev.EditFotoLokasi', compact('monev'));
    }

    public function updateFoto( MonevUpdateFotoApiRequest $request, $id_bap,){

         $validated = $request->validated();

        try{

            $monev = $this->monevInterface->getById($id_bap);

            if(!$monev){
                return redirect()->route('admin.monev.detail', ['id_bap' => $id_bap])->withErrors(['error' => 'Data tidak ditemukan']);
            }

            $this->monevInterface->updateFoto($id_bap, $validated);

            return redirect()->route('admin.monev.detail', ['id_bap' => $id_bap])->with('success', 'Data berhasil diperbarui');

         }catch(Exception $exception){
                return back()->withErrors(['error' => 'Gagal memperbarui data: ' . $exception->getMessage()]);
         }

    }

      public function destroy( $id_bap){

        try{
            $this->monevInterface->delete($id_bap);
            return redirect()->route('monev')->with('success', value: 'Data berhasil dihapus');
        }catch(Exception $exception){

            return back()->withErrors(['error' => 'Gagal menghapus data: ' . $exception->getMessage()]);

        }
    }



    // foto private
    public function showFoto($path){

        if (!Storage::disk('local')->exists($path)) {
            abort(404);
        }

        // Mengembalikan file sebagai response gambar
        return Storage::disk('local')->response($path);
    }




}
