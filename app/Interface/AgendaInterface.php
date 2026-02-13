<?php
namespace App\Interface;

interface AgendaInterface {


    public function getAll(?string $search, ?int $limit, bool $execute);

    public function create(array $data);

    public function getById(string $id);


    

}
