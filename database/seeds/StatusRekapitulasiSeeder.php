<?php

use Illuminate\Database\Seeder;
use App\StatusRekapitulasi;

class StatusRekapitulasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StatusRekapitulasi::create([
            'kd_status_rekapitulasi' => 'OK',
            'keterangan_rekapitulasi' => 'Aman'
        ]);

        StatusRekapitulasi::create([
            'kd_status_rekapitulasi' => 'SP1',
            'keterangan_rekapitulasi' => 'Surat Peringatan 1'
        ]);

        StatusRekapitulasi::create([
            'kd_status_rekapitulasi' => 'SP2',
            'keterangan_rekapitulasi' => 'Surat Peringatan 2'
        ]);

        StatusRekapitulasi::create([
            'kd_status_rekapitulasi' => 'SP3',
            'keterangan_rekapitulasi' => 'Surat Peringatan 3'
        ]);

        StatusRekapitulasi::create([
            'kd_status_rekapitulasi' => 'DO',
            'keterangan_rekapitulasi' => 'Drop Out'
        ]);
    }
}
