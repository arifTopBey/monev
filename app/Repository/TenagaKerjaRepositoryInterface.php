<?php

namespace App\Repository;

use App\Interface\TenagaKerjaInterface;
use App\Models\TenagaKerja;

class TenagaKerjaRepositoryInterface implements TenagaKerjaInterface {

     public function getAll(?string $search, ?int $limit, bool $execute){

         $query = TenagaKerja::where(function($query) use ($search){

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

    public function getById(string $id){

    }

}
