<?php

namespace App\Repository;

use App\Interface\TimMonitoringInterface;
use App\Models\TimMonitoring;

class TimMonitoringRepositoryInterface implements TimMonitoringInterface {


     public function getAll(?string $search, ?int $limit, bool $execute){

        $query = TimMonitoring::where(function($query) use ($search){

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
