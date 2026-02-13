<?php

namespace  App\Repository;

use App\Interface\IzinDimilikiInterface;
use App\Models\IzinDimiliki;

class IzinDimilikiRepositoryInterface implements IzinDimilikiInterface {


    public function getAll(?string $search, ?int $limit, bool $execute){
        
         $query = IzinDimiliki::where(function($query) use ($search){

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
