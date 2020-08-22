<?php

use Illuminate\Database\Seeder;
use App\Mahasiswa;
use App\Rekapitulasi;
use App\StatusRekapitulasi;

class RekapitulasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mahasiswa = Mahasiswa::all();
        foreach ($mahasiswa as $mhs) {
            Rekapitulasi::create([
                'nim' => $mhs->nim,
                'sakit' => 0,
                'izin' => 0,
                'alfa' => 0,
                'kd_status_rekapitulasi' => 'OK',
            ]);
        }
    }
}
