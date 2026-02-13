<?php

namespace App\Interface;

interface MonevInterface {


    public function getAll(?string $search, ?int $limit, bool $execute);
    public function getAllPaginate(?string $search, ?int $rowPerPage);


    public function create(array $data);

    public function getById(string $id);

}
