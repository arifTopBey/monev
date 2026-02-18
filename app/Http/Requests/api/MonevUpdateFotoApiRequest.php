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
}
