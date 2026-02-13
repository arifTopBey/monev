<?php

namespace App\Http\Requests\api;

use Illuminate\Foundation\Http\FormRequest;

class MonevApiStoreRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama_perusahaan' => 'required|string|max:255',
            'alamat_perusahaan' => 'required|string|max:1000',
            'bidang_usaha' => 'required|string|max:255',
            'foto_lapangan' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'foto_lapangan2' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'foto_lapangan3' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'no_telp' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'latitude' => 'required|string|max:255',
            'longitude' => 'required|string|max:255',
            'radius' => 'required|string|max:255',

        ];
    }
}
