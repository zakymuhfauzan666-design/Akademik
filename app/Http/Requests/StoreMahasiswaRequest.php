<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreMahasiswaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // belum ada login; pembatasan siapa yang boleh menambah dibahas di Pertemuan 11-12
    }

    // Dirapikan sebelum divalidasi (spasi di pinggir sudah dibuang middleware TrimStrings)
    protected function prepareForValidation(): void
    {
        $this->merge([
            'nim'  => preg_replace('/\s+/', '', (string) $this->input('nim')),
            'nama' => preg_replace('/\s+/', ' ', (string) $this->input('nama')),
        ]);
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nim'           => ['required', 'digits:8', 'unique:mahasiswa,nim'],
            'nama'          => ['required', 'string', 'min:3', 'max:100'],
            'angkatan'      => ['required', 'integer', 'between:2015,' . date('Y')],
            'prodi_id'      => ['required', 'exists:prodi,id'],
            'dosen_wali_id' => ['nullable', 'exists:dosen,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute wajib diisi.',
            'digits'   => ':attribute harus terdiri dari :digits angka.',
            'unique'   => ':attribute :input sudah terdaftar.',
            'min'      => ':attribute minimal :min karakter.',
            'max'      => ':attribute maksimal :max karakter.',
            'integer'  => ':attribute harus berupa bilangan bulat.',
            'between'  => ':attribute harus antara :min dan :max.',
            'exists'   => ':attribute yang dipilih tidak ada di database.',
        ];
    }

    public function attributes(): array
    {
        return [
            'nim'           => 'NIM',
            'nama'          => 'Nama',
            'angkatan'      => 'Angkatan',
            'prodi_id'      => 'Program studi',
            'dosen_wali_id' => 'Dosen wali',
        ];
    }
}