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
            'keterangan_surat' => 'Diajukan'
        ]);

        StatusSurat::create([
            'keterangan_surat' => 'Disetujui'
        ]);

        StatusSurat::create([
            'keterangan_surat' => 'Ditolak'
        ]);
        
        StatusSurat::create([
            'keterangan_surat' => 'Berhasil diproses'
        ]);
        
    }
}
