<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMataKuliahRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kode'     => ['required', 'string', 'max:10', 'unique:mata_kuliah,kode'],
            'nama'     => ['required', 'string', 'min:3', 'max:100'],
            'sks'      => ['required', 'integer', 'between:1,6'],
            'dosen_id' => ['required', 'exists:dosen,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'kode.required'     => 'Kode mata kuliah wajib diisi.',
            'kode.max'          => 'Kode mata kuliah maksimal 10 karakter.',
            'kode.unique'       => 'Kode mata kuliah sudah terdaftar.',
            'nama.required'     => 'Nama mata kuliah wajib diisi.',
            'nama.min'          => 'Nama mata kuliah minimal 3 karakter.',
            'nama.max'          => 'Nama mata kuliah maksimal 100 karakter.',
            'sks.required'      => 'Jumlah SKS wajib diisi.',
            'sks.integer'       => 'Jumlah SKS harus berupa bilangan bulat.',
            'sks.between'       => 'Jumlah SKS harus antara 1 dan 6.',
            'dosen_id.required' => 'Dosen pengampu wajib dipilih.',
            'dosen_id.exists'   => 'Dosen pengampu tidak ditemukan di database.',
        ];
    }
}