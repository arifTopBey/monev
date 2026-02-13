<?php

namespace App\Repository;

use App\Interface\MonevInterface;
use App\Models\Monev;
use Exception;
use Illuminate\Support\Facades\DB;

class MonevRepositoryInterface implements MonevInterface {


     public function getAll(?string $search, ?int $limit, bool $execute){

        $query = Monev::where(function($query) use ($search){

            if($search){
                $query->search($search);
            }
        });

        if($limit){
            $query->take($limit);
        }

        if($execute){
            return $query->get();
        }

        return $query;
    }

     public function getAllPaginate(?string $search, ?int $rowPerPage){

        $query = $this->getAll($search, $rowPerPage, false);

        return  $query->paginate($rowPerPage);

    }

    public function create(array $data){
        DB::beginTransaction();

        try{

        //  'nama_perusahaan' => 'required|string|max:255',
        //     'alamat_perusahaan' => 'required|string|max:1000',
        //     'bidang Usaha' => 'required|string|max:255',
        //     'foto_lapangan' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        //     'foto_lapangan2' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        //     'foto_lapangan3' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        //     'no_tlp' => 'required|string|max:255',
        //     'location' => 'required|string|max:255',
        //     'latitude' => 'required|string|max:255',
        //     'longtitude' => 'required|string|max:255',
        //     'radius' => 'required|string|max:255',

            $monev = new Monev();
            $monev->nama_perusahaan = $data['nama_perusahaan'];
            $monev->bidang_usaha = $data['bidang_usaha'];
            $monev->alamat_perusahaan = $data['alamat_perusahaan'];
            $monev->foto_lapangan = $data['foto_lapangan']->store('uploads', 'local');

            if(isset($data['foto_lapangan2'])){
                $monev->foto_lapangan2 = $data['foto_lapangan2']->store('uploads', 'local');;
            }
            if(isset($data['foto_lapangan3'])){
                $monev->foto_lapangan3 = $data['foto_lapangan3']->store('uploads', 'local');;
            }
            $monev->no_telp = $data['no_telp'];
            $monev->location = $data['location'];
            $monev->latitude = $data['latitude'];
            $monev->longitude = $data['longitude'];
            $monev->radius = $data['radius'];


            $monev->save();

            DB::commit();

            return $monev;
        }catch(Exception $exception){

            DB::rollBack();
            throw new Exception($exception->getMessage());
        }
    }

    public function getById(string $id){

    }
}
