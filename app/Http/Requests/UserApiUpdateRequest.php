<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserApiUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        // Mengambil ID user dari route (asumsi nama parameter di route adalah 'user')
        // Contoh: Route::put('users/{user}', ...)
        $userId = $this->route('id') ?? $this->id;
       
        return [
            'username' => [
                'nullable', 'max:255', 'string',
            ],
            'firstname' => 'nullable|max:255|string',
            'lastname' => 'nullable|max:255|string',
            'mobile_no' => 'nullable|max:255|string',
            'image' => 'nullable|max:2048|image|mimes:png,jpg,jpeg', 
            'role_id' => 'nullable|exists:roles,id', 
            'password' => 'nullable|max:255|string|min:8',
           
            // 'email' => 'nullable|email|unique:users,email,'. $this->route('id')
            'email' => 'nullable|email|unique:users,email,' . ($this->route('id') ?? $this->id ?? $this->user_id)
        //     'email' => [
        //     'nullable', 'email',
        //     Rule::unique('users', 'email')->ignore($userId),
        // ],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute wajib diisi.',
            'unique'   => ':attribute sudah terdaftar, gunakan yang lain.',
            'max'      => ':attribute tidak boleh lebih dari :max karakter.',
            'min'      => ':attribute minimal harus :min karakter.',
            'email'    => 'Format email tidak valid.',
            'image'    => ':attribute harus berupa file gambar.',
            'mimes'    => ':attribute harus berformat: png, jpg, atau jpeg.',
            'exists'   => 'Role yang dipilih tidak valid.',
        ];
    }

    public function attributes(): array
    {
        return [
            'username'   => 'Nama pengguna',
            'firstname'  => 'Nama depan',
            'lastname'   => 'Nama belakang',
            'mobile_no'  => 'Nomor ponsel',
            'image'      => 'Foto profil',
            'role_id'    => 'Role pengguna',
            'password'   => 'Kata sandi',
            'email'      => 'Alamat email',
        ];
    }
}