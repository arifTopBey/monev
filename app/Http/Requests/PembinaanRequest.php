<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PembinaanRequest extends FormRequest
{



        /**
         * Get the validation rules that apply to the request.
         *
         * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
         */
        public function rules(): array
        {
            return [
                'namaPerusahaan' => 'required|string|max:255',
                'alamatPerusahaan' => 'required|string|max:1000',
                'noTelpHp' => 'required|string|max:255',
                'namaPeserta' => 'required|string|max:255',
                'agendaPembinaanId' => 'required|exists:ci_pembinaan_id,id',
                'tglPembinaan' => 'required|date',
            ];
        }

        public function messages(): array
        {
            return [
                'namaPerusahaan.required' => 'Nama perusahaan wajib diisi.',
                'namaPerusahaan.string' => 'Nama perusahaan harus berupa teks.',
                'namaPerusahaan.max' => 'Nama perusahaan maksimal 255 karakter.',

                'alamatPerusahaan.required' => 'Alamat perusahaan wajib diisi.',
                'alamatPerusahaan.string' => 'Alamat perusahaan harus berupa teks.',
                'alamatPerusahaan.max' => 'Alamat perusahaan maksimal 1000 karakter.',

                'noTelpHp.required' => 'Nomor telepon/HP wajib diisi.',
                'noTelpHp.string' => 'Nomor telepon/HP harus berupa teks.',
                'noTelpHp.max' => 'Nomor telepon/HP maksimal 255 karakter.',

                'namaPeserta.required' => 'Nama peserta wajib diisi.',
                'namaPeserta.string' => 'Nama peserta harus berupa teks.',
                'namaPeserta.max' => 'Nama peserta maksimal 255 karakter.',

                'agendaPembinaanId.required' => 'Agenda pembinaan wajib dipilih.',
                'agendaPembinaanId.exists' => 'Agenda pembinaan yang dipilih tidak valid.',

                'tglPembinaan.required' => 'Tanggal pembinaan wajib diisi.',
                'tglPembinaan.date' => 'Tanggal pembinaan harus berupa format tanggal yang valid.',
            ];
        }
}
