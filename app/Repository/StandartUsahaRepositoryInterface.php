<?php

namespace App\Repository;

use App\Interface\StandartUsahaInterface;
use App\Models\StandartUsaha;

class StandartUsahaRepositoryInterface implements StandartUsahaInterface {

 public function getAll(?string $search, ?int $limit, bool $execute){

        $query = StandartUsaha::where(function($query) use ($search){

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
