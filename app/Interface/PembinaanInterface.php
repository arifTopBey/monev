<?php

namespace App\Interface;


interface PembinaanInterface {

    public function getAll(?string $search, ?int $limit, bool $execute);
    public function getAllPaginate(?string $search, ?int $rowPerPage);
    public function create(array $data);

    public function getById(int $id);

    public function delete(int $id);
}
