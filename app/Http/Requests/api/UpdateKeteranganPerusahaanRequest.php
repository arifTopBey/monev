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

    public function messages(): array
    {
        return [
            'nama_perusahaan.string' => 'Nama perusahaan harus berupa teks.',
            'nama_perusahaan.max' => 'Nama perusahaan maksimal 255 karakter.',

            'bidang_usaha.string' => 'Bidang usaha harus berupa teks.',
            'bidang_usaha.max' => 'Bidang usaha maksimal 255 karakter.',

            'status.string' => 'Status perusahaan harus berupa teks.',
            'status.max' => 'Status perusahaan maksimal 255 karakter.',

            'npwp.string' => 'NPWP harus berupa teks.',
            'npwp.max' => 'NPWP maksimal 255 karakter.',

            'nama_pemimpin_perusahaan.string' => 'Nama pemimpin perusahaan harus berupa teks.',
            'nama_pemimpin_perusahaan.max' => 'Nama pemimpin perusahaan maksimal 255 karakter.',

            'nilai_investasi.string' => 'Nilai investasi harus berupa teks.',
            'nilai_investasi.max' => 'Nilai investasi maksimal 255 karakter.',

            'jumlah_tenaga_kerja_asing.integer' => 'Jumlah tenaga kerja asing harus berupa angka.',

            'jumlah_tenaga_kerja_indonesia.integer' => 'Jumlah tenaga kerja Indonesia harus berupa angka.',

            'aspek_lingkungan.string' => 'Aspek lingkungan harus berupa teks.',
            'aspek_lingkungan.max' => 'Aspek lingkungan maksimal 255 karakter.',

            'kelengkapan_legalitas.string' => 'Kelengkapan legalitas harus berupa teks.',
            'kelengkapan_legalitas.max' => 'Kelengkapan legalitas maksimal 255 karakter.',
        ];
    }
}
