<?php

namespace App\Repository;

use App\Interface\StandartProductInterface;
use App\Models\StandartProduct;

class StandartProductRepositoryInterface implements StandartProductInterface {



     public function getAll(?string $search, ?int $limit, bool $execute){

        $query = StandartProduct::where(function($query) use ($search){

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
