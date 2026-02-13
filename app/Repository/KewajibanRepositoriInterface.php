<?php

namespace App\Repository;

use App\Interface\KewajibanInterface;
use App\Models\Kewajiban;

class KewajibanRepositoriInterface implements KewajibanInterface {

    public function getAll(?string $search, ?int $limit, bool $execute){

         $query = Kewajiban::where(function($query) use ($search){

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
