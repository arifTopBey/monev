<?php

namespace App\Interface;

interface MonevInterface {


    public function getAll(?string $search, ?int $limit, bool $execute);
    public function getAllPaginate(?string $search, ?int $rowPerPage);

    public function create(array $data);

    public function getById(string $id);

    public function updateUmum($id_bap, array $data);

    public function updateKeteranganPerusahaan($id_bap, array $data);

    public function updateHasilKesimpulan($id_bap, array $data);

}
