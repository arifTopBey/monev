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
}
