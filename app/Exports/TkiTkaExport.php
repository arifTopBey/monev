<?php

namespace App\Exports;

use App\Models\Monev;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping; 

class TkiTkaExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping
{
    private $rowNumber = 0; 

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
         return Monev::select(
            'nama_perusahaan',
            'jumlah_tenaga_kerja_indonesia',
            'jumlah_tenaga_kerja_asing'
        )->get();
    }

    /**
    * @var Monev $monev
    */
    public function map($monev): array
    {
        // Setiap baris diproses di sini, kita tambah nomor urut
        $this->rowNumber++;

        return [
            $this->rowNumber,
            $monev->nama_perusahaan,
            $monev->jumlah_tenaga_kerja_indonesia ? $monev->jumlah_tenaga_kerja_indonesia : 0,
            $monev->jumlah_tenaga_kerja_asing ? $monev->jumlah_tenaga_kerja_asing : 0,
        ];
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Perusahaan',
            'Tenaga Kerja Indonesia',
            'Tenaga Kerja Asing'
        ];
    }
}