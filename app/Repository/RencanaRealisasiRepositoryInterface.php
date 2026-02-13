<?php
namespace   App\Repository;

use App\Interface\RencanaRealisasiInterface;
use App\Models\RencanaRealisasi;

class RencanaRealisasiRepositoryInterface implements RencanaRealisasiInterface{

    public function getAll(?string $search, ?int $limit, bool $execute){

        $query = RencanaRealisasi::where(function($query) use ($search){

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

    public function create(array $data){

    }

    public function getById(int $id){

    }
}
