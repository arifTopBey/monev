<?php

namespace App\Http\Requests\api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMonevUmumRequest extends FormRequest
{
    

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return [
            'nama_penerima' => 'nullable|string|max:255',
            'tanggal_bap' => 'nullable|date',
            'jabatan' => 'nullable|string|max:255',
            'alamat_perusahaan' => 'nullable|string|max:255',
            'no_telp' => 'nullable|string|max:255'
        ];
    }
}
