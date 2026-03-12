<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IzinDimilikiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'id_bap' => $this->id_bap,
            'nib' => $this->nib,
            'izin_prinsip' => $this->ip,
            'izin_lingkungan' => $this->il,
            'site_plant' => $this->sp,
            'upl_ukl' => $this->upam,
            'imb' => $this->imb,
            'iui' => $this->iui,
            'sertifikasi_laik_fungsi' => $this->slf,
            'bpjs' => $this->bpjs,
            'izin_lokasi' => $this->pkkpr,
            'sertifikat_standart' => $this->sertifikat_standar
        ];
    }
}
