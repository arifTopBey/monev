<?php

namespace App\Interface;


interface PembinaanInterface {

    public function getAll(?string $search, ?int $limit, bool $execute, array $filters = []);
    public function getAllPaginate(?string $search, ?int $rowPerPage,  array $filters = []);
    public function create(array $data);

    public function getById(int $id);

    public function delete(int $id);
}
