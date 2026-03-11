<?php

namespace App\Exports;

use App\Models\Pembinaan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class RealisasiPembinaanExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        return Pembinaan::select(
            'dateCreated',
            'namaPerusahaan',
            'alamatPerusahaan',
            'hasilPembinaan'
        )->get()->map(function ($item) {

            return [
                'Tanggal Pembinaan' => $item->dateCreated,
                'Nama Perusahaan' => $item->namaPerusahaan,
                'Alamat' => $item->alamatPerusahaan,
                'Agenda Pembinaan' => 'Pembuatan LKPM',
                'Hasil Pembinaan' => $item->hasilPembinaan ? 'Sudah Lapor' : 'Belum Lapor',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Tanggal Pembinaan',
            'Nama Perusahaan',
            'Alamat',
            'Agenda Pembinaan',
            'Hasil Pembinaan'
        ];
    }
}