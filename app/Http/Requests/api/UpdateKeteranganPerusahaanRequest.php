<?php

namespace App\Http\Requests\api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateKeteranganPerusahaanRequest extends FormRequest
{
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama_perusahaan' => 'nullable|string|max:255',
            'bidang_usaha' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
            'npwp' => 'nullable|string|max:255',
            'nama_pemimpin_perusahaan' => 'nullable|string|max:255',
            'nilai_investasi' => 'nullable|string|max:255',
            'jumlah_tenaga_kerja_asing' => 'nullable|integer',
            'jumlah_tenaga_kerja_indonesia' => 'nullable|integer',
            'aspek_lingkungan' => 'nullable|string|max:255',
            'kelengkapan_legalitas' => 'nullable|string|max:255'
        ];
    }
}
