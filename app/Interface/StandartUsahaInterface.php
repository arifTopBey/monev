<?php

namespace App\Interface;

interface StandartUsahaInterface {


    public function getAll(?string $search, ?int $limit, bool $execute);

    public function create(array $data);

    public function getById(int $id);
}
