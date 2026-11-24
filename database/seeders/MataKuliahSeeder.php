<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MataKuliahSeeder extends Seeder
{
    public function run(): void
    {
        $dosenIds = DB::table('dosen')->pluck('id')->all();

        $mataKuliah = [
            ['kode' => 'TIF301', 'nama' => 'Basis Data', 'sks' => 3],
            ['kode' => 'TIF302', 'nama' => 'Pemrograman Web', 'sks' => 3],
            ['kode' => 'TIF303', 'nama' => 'Struktur Data', 'sks' => 3],
            ['kode' => 'TIF304', 'nama' => 'Jaringan Komputer', 'sks' => 2],
            ['kode' => 'TIF305', 'nama' => 'Rekayasa Perangkat Lunak', 'sks' => 3],
            ['kode' => 'TIF306', 'nama' => 'Sistem Operasi', 'sks' => 3],
        ];

        foreach ($mataKuliah as &$mk) {
            $mk['dosen_id'] = $dosenIds[array_rand($dosenIds)];
            $mk['created_at'] = now();
            $mk['updated_at'] = now();
        }
        unset($mk);

        DB::table('mata_kuliah')->insert($mataKuliah);
    }
}