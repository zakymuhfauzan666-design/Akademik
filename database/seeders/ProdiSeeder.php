<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('prodi')->insert([
            [
                'kode' => 'TI',
                'nama' => 'Teknik Informatika',
                'jenjang' => 'D4',
                'ketua_prodi' => 'Pak Aris',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'TK',
                'nama' => 'Teknik Komputer',
                'jenjang' => 'D3',
                'ketua_prodi' => 'Bu Dini',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}