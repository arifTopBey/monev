<?php

namespace App\Exports;

use App\Models\Monev;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PembinaanExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        return Monev::with(['izinLKPM','izinDimiliki'])->get()->map(function ($monev) {

            return [
                'Tgl Monev' => $monev->tanggal_bap,
                'Nama Perusahaan' => $monev->nama_perusahaan,
                'Alamat' => $monev->alamat_perusahaan,
                'Jumlah Investasi' => $monev->nilai_investasi,
                'Jumlah Tenaga Kerja' => $monev->jumlah_tenaga_kerja_asing + $monev->jumlah_tenaga_kerja_indonesia,
                'Izin Dimiliki' => 'LLKPL',
                'LKPM' => ($monev->izinLKPM && $monev->izinLKPM->statusLapor == 1) ? 'Ya' : 'Tidak',
                'Izin Lokasi / PPKPR' => ($monev->izinDimiliki && $monev->izinDimiliki->pkkpr == 1) ? 'Ya' : 'Tidak',
                'Izin Lingkungan' => ($monev->izinDimiliki && $monev->izinDimiliki->il == 1) ? 'Ya' : 'Tidak',
                'Izin Sertifikat Standar' => ($monev->izinDimiliki && $monev->izinDimiliki->sertifikat_standar == 1) ? 'Ya' : 'Tidak',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Tgl Monev',
            'Nama Perusahaan',
            'Alamat',
            'Jumlah Investasi',
            'Jumlah Tenaga Kerja',
            'Izin Dimiliki',
            'LKPM',
            'Izin Lokasi / PPKPR',
            'Izin Lingkungan',
            'Izin Sertifikat Standar'
        ];
    }
}