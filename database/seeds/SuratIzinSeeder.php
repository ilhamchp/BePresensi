<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\SuratIzin;
use App\Mahasiswa;
use App\StatusPresensi as JenisIzin;
use App\StatusSurat;

class SuratIzinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i<=20; $i++){
            $faker = Faker::create();
            $mahasiswa = Mahasiswa::all()->random(1);
            $status = StatusSurat::all()->random(1);
            $jenis = JenisIzin::where('kd_status_presensi','!=','A')->where('kd_status_presensi','!=','H')->get()->random(1);
            foreach ($jenis as $jenisIzin){
                $jenisSuratIzin = $jenisIzin;
                switch ($jenisIzin->kd_status_presensi) {
                    case 'S':
                        $keterangan = 'sakit';
                        break;
                    case 'I':
                        $keterangan = 'izin';
                        break; 
                    default:
                        $keterangan = 'dispensasi';
                        break;
                }
            }
            // Generate kode surat izin berdasarkan database
            $temp = SuratIzin::all()->last();
            $kd_surat_izin = 'SuratIzin0001';
            if($temp){
                $kd_surat_izin = ++$temp->kd_surat_izin; 
            }

            $suratIzin = new SuratIzin;
            $suratIzin->kd_surat_izin = $kd_surat_izin;
            $suratIzin->tgl_mulai = $faker->dateTimeThisYear($max= 'now')->format('Y-m-d');
            $suratIzin->tgl_selesai = $faker->dateTimeBetween($startDate = $suratIzin->tgl_mulai ,$endDate = '+01 week')->format('Y-m-d');
            // karena izin sakit tidak perlu memiliki waktu izin
            if($keterangan != 'sakit'){
                $suratIzin->jam_selesai = $faker->time('h:i:s');
                $suratIzin->jam_mulai = $faker->time('h:i:s', $suratIzin->jam_selesai);    
            }
            $suratIzin->catatan_surat = 'Saya tidak bisa hadir karena '. $keterangan;
            $suratIzin->foto_surat =  $kd_surat_izin . '.jpg';
            $suratIzin->mahasiswa()->associate($mahasiswa[0]);
            $suratIzin->jenisIzin()->associate($jenis[0]);
            $suratIzin->statusSurat()->associate($status[0]);
            // dd($suratIzin);
            $suratIzin->save();
        }
    }
}
