<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UpdateProfileRequest extends FormRequest
{
   
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // return [

        //     'username' => 'nullable|unique:users,username|max:255|string',
        //     'firstname' => 'nullable|max:255|string',
        //     'lastname' => 'nullable|max:255|string',
        //     'email' => 'nullable|email|max:255|unique:users,email',
        //     'mobile_no' => 'nullable|unique:users,mobile_no|max:120',



        // ];
         $userId = auth()->id();

        return [
            'username' => [
                'nullable',
                'max:255',
                'string',
                Rule::unique('users', 'username')->ignore($userId),
            ],

            'firstname' => 'nullable|max:255|string',

            'lastname' => 'nullable|max:255|string',

            'email' => [
                'nullable',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($userId),
            ],

            'mobile_no' => [
                'nullable',
                'max:120',
                Rule::unique('users', 'mobile_no')->ignore($userId),
            ],
        ];
    }

    public function messages(): array
{
    return [
        'username.unique' => 'Username sudah digunakan.',
        'username.max' => 'Username maksimal 255 karakter.',
        'username.string' => 'Username harus berupa teks.',

        'firstname.max' => 'Nama depan maksimal 255 karakter.',
        'firstname.string' => 'Nama depan harus berupa teks.',

        'lastname.max' => 'Nama belakang maksimal 255 karakter.',
        'lastname.string' => 'Nama belakang harus berupa teks.',

        'email.email' => 'Format email tidak valid.',
        'email.max' => 'Email maksimal 255 karakter.',
        'email.unique' => 'Email sudah digunakan.',

        'mobile_no.unique' => 'Nomor HP sudah digunakan.',
        'mobile_no.max' => 'Nomor HP maksimal 120 karakter.',
    ];
}
}
