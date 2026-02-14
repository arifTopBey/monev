<?php

namespace App\Http\Controllers;

use App\Http\Requests\api\MonevApiStoreRequest;
use App\Http\Requests\api\UpdateKesimpulanRequest;
use App\Http\Requests\api\UpdateKeteranganPerusahaanRequest;
use App\Http\Requests\api\UpdateMonevUmumRequest;
use App\Interface\MonevInterface;
use Exception;
use Illuminate\Http\Request;

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

        $data = $this->monevInterface->getAllPaginate($search ?? null, $perPage);
        $data->appends([
            'search' => $search,
            'row_per_page' => $perPage
            ]);

        return view('admin.monev.index', compact('data'));
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

    public function showHasilFoto(){
        return view('admin.monev.EditFotoLokasi');
    }




}
