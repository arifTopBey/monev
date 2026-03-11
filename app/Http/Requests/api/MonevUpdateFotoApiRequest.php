<?php

namespace App\Http\Requests\api;

use Illuminate\Foundation\Http\FormRequest;

class MonevUpdateFotoApiRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'location' => 'nullable|max:2048|string',
            'radius' => 'nullable|max:2048|string',
            'latitude' => 'nullable|max:2048|string',
            'longitude' => 'nullable|max:2048|string',
            'foto_lapangan' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'foto_lapangan2' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'foto_lapangan3' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'location.string' => 'Lokasi harus berupa teks.',
            'location.max' => 'Lokasi maksimal 2048 karakter.',

            'radius.string' => 'Radius harus berupa teks.',
            'radius.max' => 'Radius maksimal 2048 karakter.',

            'latitude.string' => 'Latitude harus berupa teks.',
            'latitude.max' => 'Latitude maksimal 2048 karakter.',

            'longitude.string' => 'Longitude harus berupa teks.',
            'longitude.max' => 'Longitude maksimal 2048 karakter.',

            'foto_lapangan.image' => 'Foto lapangan harus berupa gambar.',
            'foto_lapangan.mimes' => 'Format foto lapangan harus png, jpg, atau jpeg.',
            'foto_lapangan.max' => 'Ukuran foto lapangan maksimal 2MB.',

            'foto_lapangan2.image' => 'Foto lapangan kedua harus berupa gambar.',
            'foto_lapangan2.mimes' => 'Format foto lapangan kedua harus png, jpg, atau jpeg.',
            'foto_lapangan2.max' => 'Ukuran foto lapangan kedua maksimal 2MB.',

            'foto_lapangan3.image' => 'Foto lapangan ketiga harus berupa gambar.',
            'foto_lapangan3.mimes' => 'Format foto lapangan ketiga harus png, jpg, atau jpeg.',
            'foto_lapangan3.max' => 'Ukuran foto lapangan ketiga maksimal 2MB.',
        ];
    }

}
