<?php

use Illuminate\Database\Seeder;
use App\Kelas;
use App\Dosen;


class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /**
         * NOTE !!!!
         * Data merupakan data palsu
         * dan bukan data real dari JTK!
         */
        $this->storeKelas([
            'kd_kelas' => 'D3A2017',
            'tingkat_kelas' => '3',
            'prodi' => 'D3',
            'angkatan' => '2017',
            'kd_wali_dosen' => 'KO008N'
        ]);

        $this->storeKelas([
            'kd_kelas' => 'D3B2017',
            'tingkat_kelas' => '3',
            'prodi' => 'D3',
            'angkatan' => '2017',
            'kd_wali_dosen' => 'KO018N'
        ]);

        $this->storeKelas([
            'kd_kelas' => 'D3A2018',
            'tingkat_kelas' => '2',
            'prodi' => 'D3',
            'angkatan' => '2018',
            'kd_wali_dosen' => 'KO009N'
        ]);

        $this->storeKelas([
            'kd_kelas' => 'D3B2018',
            'tingkat_kelas' => '2',
            'prodi' => 'D3',
            'angkatan' => '2018',
            'kd_wali_dosen' => 'KO052N'
        ]);

        $this->storeKelas([
            'kd_kelas' => 'D3A2019',
            'tingkat_kelas' => '1',
            'prodi' => 'D3',
            'angkatan' => '2019',
            'kd_wali_dosen' => 'KO061N'
        ]);

        $this->storeKelas([
            'kd_kelas' => 'D3B2019',
            'tingkat_kelas' => '1',
            'prodi' => 'D3',
            'angkatan' => '2019',
            'kd_wali_dosen' => 'KO003N'
        ]);

        $this->storeKelas([
            'kd_kelas' => 'D4A2016',
            'tingkat_kelas' => '4',
            'prodi' => 'D4',
            'angkatan' => '2016',
            'kd_wali_dosen' => 'KO001N'
        ]);

        $this->storeKelas([
            'kd_kelas' => 'D4A2017',
            'tingkat_kelas' => '3',
            'prodi' => 'D4',
            'angkatan' => '2017',
            'kd_wali_dosen' => 'KO017N'
        ]);

        $this->storeKelas([
            'kd_kelas' => 'D4A2018',
            'tingkat_kelas' => '2',
            'prodi' => 'D4',
            'angkatan' => '2018',
            'kd_wali_dosen' => 'KO059N'
        ]);

        $this->storeKelas([
            'kd_kelas' => 'D4A2019',
            'tingkat_kelas' => '1',
            'prodi' => 'D4',
            'angkatan' => '2019',
            'kd_wali_dosen' => 'KO006N'
        ]);

        $this->storeKelas([
            'kd_kelas' => 'D4B2019',
            'tingkat_kelas' => '1',
            'prodi' => 'D4',
            'angkatan' => '2019',
            'kd_wali_dosen' => 'KO002N'
        ]);
    }

    public function storeKelas($data){
        $dosen = Dosen::find($data['kd_wali_dosen']);

        $kelas = new Kelas;
        $kelas->kd_kelas = $data['kd_kelas'];
        $kelas->tingkat_kelas = $data['tingkat_kelas'];
        $kelas->prodi = $data['prodi'];
        $kelas->angkatan = $data['angkatan'];
        $kelas->waliDosen()->associate($dosen);
        $kelas->save();
    }
}
