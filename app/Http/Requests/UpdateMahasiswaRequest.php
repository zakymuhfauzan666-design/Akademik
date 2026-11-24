<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UpdateMahasiswaRequest extends StoreMahasiswaRequest
{
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            // NIM boleh sama dengan miliknya sendiri, tetapi tidak boleh sama dengan mahasiswa lain
            'nim' => ['required', 'digits:8', Rule::unique('mahasiswa', 'nim')->ignore($this->route('mahasiswa'))],
        ]);
    }
}