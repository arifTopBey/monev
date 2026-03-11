<?php

namespace App\Exports;

use App\Models\Monev;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class MonevExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        return Monev::select(
            'tanggal_bap',
            'nama_perusahaan'
        )->get();
    }

    public function headings(): array
    {
        return [
            'Tanggal BAP',
            'Nama Perusahaan'
        ];
    }
}