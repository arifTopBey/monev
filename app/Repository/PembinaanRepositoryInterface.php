<?php

namespace App\Repository;

use App\Interface\PembinaanInterface;
// use App\Models\Agenda;
use App\Models\Pembinaan;
use Exception;
use Illuminate\Support\Facades\DB;

class PembinaanRepositoryInterface implements PembinaanInterface {

    public function getAll(?string $search, ?int $limit, bool $execute,array $filters = []){

        $query = Pembinaan::where(function($query) use ($search){

            if($search){
                $query->search($search);
            }
        })->with(['izinDimiliki']);

        if (!empty($filters['start_date'])) {
        $query->whereDate('dateCreated', '>=', $filters['start_date']);
        }

        if (!empty($filters['end_date'])) {
            $query->whereDate('dateCreated', '<=', $filters['end_date']);
        }

        $query->orderByDesc('dateCreated');
        if($limit){
            $query->take($limit);
        }

        if($execute){
            return $query->get();
        }

        return $query;
    }

    public function getAllPaginate(?string $search, ?int $rowPerPage, array $filters = []){

        $query = $this->getAll($search, $rowPerPage, false, $filters);

        return  $query->paginate($rowPerPage);

    }


    public function create(array $data){

        DB::beginTransaction();

        try{

            $pembinaan = new Pembinaan();
            $pembinaan->namaPerusahaan = $data['namaPerusahaan'];
            $pembinaan->alamatPerusahaan = $data['alamatPerusahaan'];
            $pembinaan->noTelpHp = $data['noTelpHp'];
            $pembinaan->namaPeserta = $data['namaPeserta'];
            $pembinaan->agendaPembinaanId = $data['agendaPembinaanId'];
            $pembinaan->tglPembinaan = $data['tglPembinaan'];
            $pembinaan->hasilPembinaan = 0; //default 0
            $pembinaan->dateCreated = now();


            $pembinaan->save();

            DB::commit();

            return $pembinaan;
        }catch(Exception $exception){

            DB::rollBack();
            throw new Exception($exception->getMessage());
        }
    }

    public function getById(int $id){

        $pembinaan = Pembinaan::where('id', $id)->first();
        return $pembinaan;
    }

    public function delete(int $id){

        DB::beginTransaction();

        try{

            $pembinaan = Pembinaan::find($id);

            $pembinaan->delete();
            DB::commit();
            return $pembinaan;

        }catch(Exception $exception){

            DB::rollBack();
            throw new Exception($exception->getMessage());
        }
    }

    public function updateStatusPembinaan(int $id ){

        DB::beginTransaction();

        try{

            $pembinaan = Pembinaan::find($id);
            // $pembinaan->hasilPembinaan = ! $pembinaan->hasilPembinaan;
            $pembinaan->hasilPembinaan = ($pembinaan->hasilPembinaan == 1) ? 0 : 1;
            
            $pembinaan->update();
            DB::commit();
            return $pembinaan;

        }catch(Exception $exception){

            DB::rollBack();
            throw new Exception($exception->getMessage());
        }
        
    }
}
