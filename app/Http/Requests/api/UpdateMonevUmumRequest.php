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

    public function messages(): array
    {
        return [
            'nama_penerima.string' => 'Nama penerima harus berupa teks.',
            'nama_penerima.max' => 'Nama penerima maksimal 255 karakter.',

            'tanggal_bap.date' => 'Tanggal BAP harus berupa format tanggal yang valid.',

            'jabatan.string' => 'Jabatan harus berupa teks.',
            'jabatan.max' => 'Jabatan maksimal 255 karakter.',

            'alamat_perusahaan.string' => 'Alamat perusahaan harus berupa teks.',
            'alamat_perusahaan.max' => 'Alamat perusahaan maksimal 255 karakter.',

            'no_telp.string' => 'Nomor telepon harus berupa teks.',
            'no_telp.max' => 'Nomor telepon maksimal 255 karakter.',
        ];
    }
}
