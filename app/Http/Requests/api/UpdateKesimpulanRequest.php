<?php

namespace App\Http\Requests\api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateKesimpulanRequest extends FormRequest
{
    

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'hasil_pemeriksaan' => 'nullable|string|max:1000',
            'kesimpulan_saran' => 'nullable|string|max:1000',
        ];
    }

     public function messages(): array
    {
        return [
            'hasil_pemeriksaan.string' => 'Hasil pemeriksaan harus berupa teks.',
            'hasil_pemeriksaan.max' => 'Hasil pemeriksaan maksimal 1000 karakter.',

            'kesimpulan_saran.string' => 'Kesimpulan dan saran harus berupa teks.',
            'kesimpulan_saran.max' => 'Kesimpulan dan saran maksimal 1000 karakter.',
        ];
    }
}
