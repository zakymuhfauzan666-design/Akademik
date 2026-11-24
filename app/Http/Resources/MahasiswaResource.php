<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MahasiswaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'nim'      => $this->nim,
            'nama'     => $this->nama,
            'angkatan' => $this->angkatan,
            'status'   => $this->status,
            // whenLoaded: tampil hanya bila controller sudah memuat relasinya (with)
            'prodi'    => $this->whenLoaded('prodi', fn () => [
                'kode' => $this->prodi->kode,
                'nama' => $this->prodi->nama,
            'dosen_wali'  => $this->whenLoaded('dosenWali', fn () => $this->dosenWali?->nama),
            'mata_kuliah' => $this->whenLoaded('mataKuliah', fn () => $this->mataKuliah->map(fn ($mk) => [
                'kode'     => $mk->kode,
                'nama'     => $mk->nama,
                'semester' => $mk->pivot->semester,
                'nilai'    => $mk->pivot->nilai,
            ])),
            'ipk'         => $this->whenLoaded('mataKuliah', fn () => $this->ipk),
            ]),
        ];
    }
}