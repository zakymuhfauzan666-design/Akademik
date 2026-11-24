<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DosenSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nidn' => '0412345678',
                'nama' => 'Dini Rohmayani',
                'email' => 'dini@gmail.com',
            ],
            [
                'nidn' => '0412345679',
                'nama' => 'Aris Rismayana',
                'email' => 'aris@gmail.com',
            ],
            [
                'nidn' => '0412345680',
                'nama' => 'Castaka Agus',
                'email' => 'castaka@gmail.com',
            ],
        ];

        foreach ($data as &$dosen) {
            $dosen['created_at'] = now();
            $dosen['updated_at'] = now();
        }
        unset($dosen);

        DB::table('dosen')->insert($data);
    }
}