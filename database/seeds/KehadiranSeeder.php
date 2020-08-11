<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Kehadiran;
use App\Mahasiswa;
use App\Jadwal;
use App\Sesi;
use App\StatusPresensi;
use App\SuratIzin;

class KehadiranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for($i=0; $i<=50; $i++){
            $mhs = Mahasiswa::all()->random(1);
            $jadwal = Jadwal::all()->random(1);
            $sesi = Sesi::all()->random(1);
            $status = StatusPresensi::all()->random(1);
            $surat = SuratIzin::all()->random(1);

            $kehadiran = new Kehadiran;
            $kehadiran->mahasiswa()->associate($mhs[0]);
            $kehadiran->jadwal()->associate($jadwal[0]);
            $kehadiran->sesi()->associate($sesi[0]);
            $kehadiran->statusPresensi()->associate($status[0]);
            if($status[0]->kd_status_presensi!='H'){
                $kehadiran->suratIzin()->associate($surat[0]);
                $kehadiran->save();
            }else{
                $kehadiran->tgl_presensi = $faker->dateTimeThisYear($max='now')->format('Y-m-d');
                $kehadiran->jam_presensi = $faker->time($format = 'H:i:s',$max='now');
                $kehadiran->save();
            }
        }
    }
}
