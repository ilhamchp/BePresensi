<?php

use Illuminate\Database\Seeder;
use App\StatusPresensi;

class StatusPresensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StatusPresensi::create([
            'kd_status_presensi' => 'H',
            'keterangan_presensi' => 'Hadir'
        ]);
        
        StatusPresensi::create([
            'kd_status_presensi' => 'S',
            'keterangan_presensi' => 'Sakit'
        ]);
        
        StatusPresensi::create([
            'kd_status_presensi' => 'I',
            'keterangan_presensi' => 'Izin'
        ]);
        
        StatusPresensi::create([
            'kd_status_presensi' => 'A',
            'keterangan_presensi' => 'Alfa'
        ]);
        
    }
}
