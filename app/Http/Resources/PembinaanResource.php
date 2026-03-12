<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PembinaanResource extends JsonResource
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
            'namaPerusaan' => $this->namaPerusahaan,
            'alamatPerusahaan' => $this->alamatPerusahaan,
            'namaPeserta' => $this->namaPeserta,
            'noTelpHp' => $this->noTelpHp,
            'agenda_pembinaan' => new AgendaPembinaanResource($this->Agenda),
            'tglPembinaan' => $this->tglPembinaan,
            'hasilPembinaan' => $this->hasilPembinaan,
            'dateCreated' => $this->dateCreated
        ];
    }
}
