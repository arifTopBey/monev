<?php

namespace App\Http\Controllers;

use App\Http\Requests\api\MonevApiStoreRequest;
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

    public function show(){

        return view('admin.monev.detail');
    }


    #nanti pake id
    public function showKeteranganUmum(){

        return view('admin.monev.editKeteranganUmum');
    }

    public function showKeteranganPerusahaan(){

        return view('admin.monev.editKeteranganPerusahaan');
    }

    public function showHasilKesimpulan(){

        return view('admin.monev.editKesimpulan');
    }

    public function showHasilFoto(){
        return view('admin.monev.EditFotoLokasi');
    }




}
