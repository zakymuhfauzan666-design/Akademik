<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use App\Models\Ukm;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UkmSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['UKM-01', 'Robotika dan IoT',        'Akademik', 2018],
            ['UKM-02', 'Paduan Suara Mahasiswa',  'Seni',     2015],
            ['UKM-03', 'Futsal',                  'Olahraga', 2012],
            ['UKM-04', 'Basket',                  'Olahraga', 2013],
            ['UKM-05', 'Kewirausahaan',           'Akademik', 2019],
            ['UKM-06', 'Teater Kampus',           'Seni',     2016],
            ['UKM-07', 'Bakti Sosial',            'Sosial',   2014],
            ['UKM-08', 'Fotografi dan Film',      'Seni',     2017],
        ];

        foreach ($data as [$kode, $nama, $kategori, $tahun]) {
            Ukm::create([
                'kode'          => $kode,
                'nama'          => $nama,
                'kategori'      => $kategori,
                'tahun_berdiri' => $tahun,
            ]);
        }

        for ($n = 1; $n <= 30; $n++) {
            $mahasiswa = Mahasiswa::find($n);
            if (! $mahasiswa) {
                continue;
            }

            $ukmIds = [(($n - 1) % 8) + 1];

            if ($n % 3 !== 0) {
                $ukmIds[] = (($n * 3) % 8) + 1;
            }

            if ($n % 5 === 0) {
                $ukmIds[] = (($n * 5) % 8) + 1;
            }

            $ukmIds = array_unique($ukmIds);
            $tanggal = Carbon::create(2024, 9, 1)->addDays($n * 7)->toDateString();

            foreach ($ukmIds as $index => $ukmId) {
                $jabatan = ($index === 0 && $n <= 8) ? 'ketua' : 'anggota';

                $mahasiswa->ukm()->attach($ukmId, [
                    'jabatan'        => $jabatan,
                    'bergabung_pada' => $tanggal,
                ]);
            }
        }
    }
}