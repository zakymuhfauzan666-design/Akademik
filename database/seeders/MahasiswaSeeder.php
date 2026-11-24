<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        $prodiIds = DB::table('prodi')->pluck('id')->all();
        $dosenIds = DB::table('dosen')->pluck('id')->all();

        $data = [];

        $data[] = [
            'nim' => 'D112411068',
            'nama' => 'Zaky',
            'prodi_id' => $prodiIds[0],
            'dosen_wali_id' => $dosenIds[0],
            'angkatan' => 2024,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        for ($i = 2; $i <= 30; $i++) {
            $data[] = [
                'nim' => '2024' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'nama' => fake('id_ID')->name(),
                'prodi_id' => $prodiIds[array_rand($prodiIds)],
                'dosen_wali_id' => $dosenIds[array_rand($dosenIds)],
                'angkatan' => 2024,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('mahasiswa')->insert($data);
    }
}