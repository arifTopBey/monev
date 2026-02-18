<?php

namespace App\Http\Controllers;

use App\Http\Controllers\api\PembinaanApiController;
use App\Http\Requests\PembinaanRequest;
use App\Interface\PembinaanInterface;
use App\Models\Agenda;
use App\Models\Pembinaan;
use App\Repository\PembinaanRepositoryInterface;
use Exception;
use Illuminate\Http\Request;

class PembinaanController extends Controller
{

    private PembinaanInterface $pembinaanInterface;


    public function __construct(PembinaanInterface $pembinaanInterface){
        $this->pembinaanInterface = $pembinaanInterface;
    }


    public function index(Request $request){

        // Tangkap input dari form Blade
        $search = $request->input('search');

         // Tangkap input dari form Blade
        $perPage = $request->input('row_per_page', 10);

        $filters = [
        'start_date' => $request->input('start_date'),
        'end_date'   => $request->input('end_date'),
        ];

        // $data = $this->pembinaanInterface->getAllPaginate($search ?? null, $perPage);
        // $data->appends([
        //     'search' => $search,
        //     'row_per_page' => $perPage
        //     ]);

        $data = $this->pembinaanInterface->getAllPaginate($search, $perPage, $filters);

        // 4. Gunakan appends($request->all()) agar semua filter tidak hilang saat pindah halaman
        $data->appends($request->all());


        return view('admin.pembinaan.index', compact('data'));
    }

    public function create(){

        $agenda = Agenda::all();

        return view('admin.pembinaan.create', compact('agenda'));

    }

    public function store(PembinaanRepositoryInterface $pembinaanRepositoryInterface,PembinaanRequest $request){

        $validated = $request->validated();

        try{

            $pembinaanRepositoryInterface->create($validated);

            return redirect()->route('pembinaan')->with('success', 'Data berhasil ditambah');


        }catch(Exception $exception){
              return back()->withErrors(['error' => 'Gagal menyimpan data: ' . $exception->getMessage()]);
        }
    }

    public function destroy(int $id){

        try{
            $this->pembinaanInterface->delete($id);
            return redirect()->route('pembinaan')->with('success', value: 'Data berhasil dihapus');
        }catch(Exception $exception){

            return back()->withErrors(['error' => 'Gagal menghapus data: ' . $exception->getMessage()]);

        }
    }

}
