<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MataKuliahResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'kode'           => $this->kode,
            'nama'           => $this->nama,
            'sks'            => $this->sks,
            'dosen'          => $this->whenLoaded('dosen', fn () => $this->dosen?->nama),
            'jumlah_peserta' => $this->whenCounted('mahasiswa'),
        ];
    }
}