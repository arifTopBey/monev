<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PembinaanRequest extends FormRequest
{



    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'namaPerusahaan' => 'required|string|max:255',
            'alamatPerusahaan' => 'required|string|max:1000',
            'noTelpHp' => 'required|string|max:255',
            'namaPeserta' => 'required|string|max:255',
            'agendaPembinaanId' => 'required|exists:ci_pembinaan_id,id',
            'tglPembinaan' => 'required|date',
        ];
    }
}
