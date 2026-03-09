<?php

namespace App\Http\Controllers;

use App\Interface\PembinaanInterface;
use Exception;
use Illuminate\Http\Request;

class RealisasiPembinaanController extends Controller
{

    private PembinaanInterface $pembinaanInterface;


    public function __construct(PembinaanInterface $pembinaanInterface){
        $this->pembinaanInterface = $pembinaanInterface;
    }


    public function index(Request $request){

        $search = $request->input('search');

        $perPage = $request->input('row_per_page', 10);

        $filters = [
        'start_date' => $request->input('start_date'),
        'end_date'   => $request->input('end_date'),
        ];

        $data = $this->pembinaanInterface->getAllPaginate($search, $perPage, $filters);

        $data->appends($request->all());

        // $data = $this->pembinaanInterface->getAllPaginate($request->input('search') ?? null, $request->input('row_per_page') ?? 10);

        return view('admin.realisasi_pembinaan.index', compact('data'));
    }

    public function updateStatusPembinaan($id){

        try{    

            $pembinaan = $this->pembinaanInterface->getById($id);

            if(!$pembinaan){
                return back()->withErrors(['errorStatus' => 'Email atau password salah.']);
            }

            $updateStatus = $this->pembinaanInterface->updateStatusPembinaan($id);
            
            return response()->json([
                'success' => true,
                'data' => $updateStatus
            ]);
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }

    }
}
