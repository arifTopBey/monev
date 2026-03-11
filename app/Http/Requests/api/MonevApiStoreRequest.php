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

    public function messages(): array
    {
        return [
            'nama_perusahaan.required' => 'Nama perusahaan wajib diisi.',
            'nama_perusahaan.string' => 'Nama perusahaan harus berupa teks.',
            'nama_perusahaan.max' => 'Nama perusahaan maksimal 255 karakter.',

            'alamat_perusahaan.required' => 'Alamat perusahaan wajib diisi.',
            'alamat_perusahaan.string' => 'Alamat perusahaan harus berupa teks.',
            'alamat_perusahaan.max' => 'Alamat perusahaan maksimal 1000 karakter.',

            'bidang_usaha.required' => 'Bidang usaha wajib diisi.',
            'bidang_usaha.string' => 'Bidang usaha harus berupa teks.',
            'bidang_usaha.max' => 'Bidang usaha maksimal 255 karakter.',

            'foto_lapangan.required' => 'Foto lapangan wajib diunggah.',
            'foto_lapangan.image' => 'File foto lapangan harus berupa gambar.',
            'foto_lapangan.mimes' => 'Format foto lapangan harus png, jpg, atau jpeg.',
            'foto_lapangan.max' => 'Ukuran foto lapangan maksimal 2MB.',

            'foto_lapangan2.image' => 'File foto lapangan kedua harus berupa gambar.',
            'foto_lapangan2.mimes' => 'Format foto lapangan kedua harus png, jpg, atau jpeg.',
            'foto_lapangan2.max' => 'Ukuran foto lapangan kedua maksimal 2MB.',

            'foto_lapangan3.image' => 'File foto lapangan ketiga harus berupa gambar.',
            'foto_lapangan3.mimes' => 'Format foto lapangan ketiga harus png, jpg, atau jpeg.',
            'foto_lapangan3.max' => 'Ukuran foto lapangan ketiga maksimal 2MB.',

            'no_telp.required' => 'Nomor telepon wajib diisi.',
            'no_telp.string' => 'Nomor telepon harus berupa teks.',
            'no_telp.max' => 'Nomor telepon maksimal 255 karakter.',

            'location.required' => 'Lokasi wajib diisi.',
            'location.string' => 'Lokasi harus berupa teks.',
            'location.max' => 'Lokasi maksimal 255 karakter.',

            'latitude.required' => 'Latitude wajib diisi.',
            'latitude.string' => 'Latitude harus berupa teks.',
            'latitude.max' => 'Latitude maksimal 255 karakter.',

            'longitude.required' => 'Longitude wajib diisi.',
            'longitude.string' => 'Longitude harus berupa teks.',
            'longitude.max' => 'Longitude maksimal 255 karakter.',

            'radius.required' => 'Radius wajib diisi.',
            'radius.string' => 'Radius harus berupa teks.',
            'radius.max' => 'Radius maksimal 255 karakter.',
        ];
    }
}
