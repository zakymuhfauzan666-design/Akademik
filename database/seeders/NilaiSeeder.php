<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NilaiSeeder extends Seeder
{
    public function run(): void
    {
        $mahasiswaIds = DB::table('mahasiswa')
            ->pluck('id')
            ->all();

        $mataKuliahIds = DB::table('mata_kuliah')
            ->pluck('id')
            ->all();

        $data = [];

        foreach ($mahasiswaIds as $mahasiswaId) {
            $mataKuliahTerpilih = collect($mataKuliahIds)
                ->shuffle()
                ->take(4);

            foreach ($mataKuliahTerpilih as $mataKuliahId) {
                $data[] = [
                    'mahasiswa_id' => $mahasiswaId,
                    'mata_kuliah_id' => $mataKuliahId,
                    'semester' => '2026-Ganjil',
                    'nilai' => rand(55, 100),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        foreach (array_chunk($data, 500) as $batch) {
            DB::table('mahasiswa_mata_kuliah')->insert($batch);
        }
    }
}