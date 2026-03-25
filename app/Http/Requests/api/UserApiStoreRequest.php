<?php

namespace App\Http\Requests\api;

use Illuminate\Foundation\Http\FormRequest;

class UserApiStoreRequest extends FormRequest
{
   

  
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required|max:255|string',
            'firstname' => 'required|max:255|string',
            'lastname' => 'required|max:255|string',
            'mobile_no' => 'required|max:255|string',
            'image' => 'nullable|max:2048|string|image|mimes:png,jpg,jpeg',
            'role_id' => 'required|exists:roles,id',
            'password' => 'required|max:255|string|min:8',
            'email' => 'required|max:255|string|email',

        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute wajib diisi.',
            'max'      => ':attribute maksimal :max karakter.',
            'min'      => ':attribute minimal :min karakter.',
            'string'   => ':attribute harus berupa teks.',
            'email'    => 'Format email tidak valid.',
            'image'    => ':attribute harus berupa gambar.',
            'mimes'    => ':attribute harus berformat: png, jpg, atau jpeg.',
            'max'      => [
                'numeric' => ':attribute tidak boleh lebih dari :max.',
                'file'    => ':attribute tidak boleh lebih dari :max kilobyte.',
                'string'  => ':attribute tidak boleh lebih dari :max karakter.',
            ],
        ];
    }

    /**
     * Custom attributes for clearer error messages.
     */
    public function attributes(): array
    {
        return [
            'username'   => 'Nama pengguna',
            'firstname'  => 'Nama depan',
            'lastname'   => 'Nama belakang',
            'mobile_no'  => 'Nomor ponsel',
            'image'      => 'Foto profil',
            'password'   => 'Kata sandi',
            'email'      => 'Alamat email',
        ];
    }
}
