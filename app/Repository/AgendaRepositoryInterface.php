<?php

namespace App\Repository;

use App\Interface\AgendaInterface;
use App\Models\Agenda;
use Exception;
use Illuminate\Support\Facades\DB;

class AgendaRepositoryInterface implements AgendaInterface {
    public function getAll(?string $search, ?int $limit, bool $execute){

        $query = Agenda::where(function($query) use ($search){

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
        
        DB::beginTransaction();

        try{

            $agenda = new Agenda();
            $agenda->namaAgenda = $data['namaAgenda'];

            $agenda->save();

            DB::commit();

            return $agenda;
        }catch(Exception $exception){

            DB::rollBack();
            throw new Exception($exception->getMessage());
        }
    }

    public function getById(string $id){

    }
}
