<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Jadwal;
use App\BeritaAcara;
class BeritaAcaraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for($i=0; $i<=20; $i++){
            $temp = BeritaAcara::all()->last();
            $kd_berita_acara = 'BeritaAcara0001';
            if($temp){
                $kd_berita_acara = ++$temp->kd_berita_acara;    
            }
            $jadwal = Jadwal::all()->random(1);
            $desk_perkuliahan = $faker->sentence();
            $desk_penugasan = $faker->sentence();
            $tgl_pertemuan = $faker->dateTimeThisYear($max='now')->format('Y-m-d');
            $mhs_hadir = $faker->numberBetween($min = 25, $max=32);
            $mhs_tidak_hadir = $faker->numberBetween($min = 0, $max=7);
            
            // ASSIGN DATA
            $beritaAcara = new BeritaAcara;
            $beritaAcara->kd_berita_acara = $kd_berita_acara;
            $beritaAcara->jadwal()->associate($jadwal[0]);
            $beritaAcara->desk_perkuliahan = $desk_perkuliahan;
            $beritaAcara->desk_penugasan = $desk_penugasan;
            $beritaAcara->tgl_pertemuan = $tgl_pertemuan;
            $beritaAcara->mhs_hadir = $mhs_hadir;
            $beritaAcara->mhs_tidak_hadir = $mhs_tidak_hadir;
            $beritaAcara->save();
        }
    }
}
