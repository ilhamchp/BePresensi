<?php

use Illuminate\Database\Seeder;
use App\StatusSurat;

class StatusSuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StatusSurat::create([
            'kd_status_surat' => '0',
            'keterangan_surat' => 'Diajukan'
        ]);

        StatusSurat::create([
            'kd_status_surat' => '1',
            'keterangan_surat' => 'Disetujui'
        ]);

        StatusSurat::create([
            'kd_status_surat' => '2',
            'keterangan_surat' => 'Ditolak'
        ]);
        
        StatusSurat::create([
            'kd_status_surat' => '3',
            'keterangan_surat' => 'Berhasil diproses'
        ]);
        
    }
}
