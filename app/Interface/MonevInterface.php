<?php

namespace App\Interface;

interface MonevInterface {


    public function getAll(?string $search, ?int $limit, bool $execute,array $filters = []);
    public function getAllPaginate(?string $search, ?int $rowPerPage,array $filters = []);

    public function create(array $data);

    public function getById(string $id);

    public function updateUmum($id_bap, array $data);

    public function updateKeteranganPerusahaan($id_bap, array $data);

    public function updateHasilKesimpulan($id_bap, array $data);

    public function updateFoto($id_bap, array $data);

    public function delete($id_bap);

}
