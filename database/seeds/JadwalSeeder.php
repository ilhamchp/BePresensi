<?php

use Illuminate\Database\Seeder;
use App\Jadwal;
use App\Kelas;
use App\Hari;
use App\Sesi;
use App\Ruang;
use App\Matakuliah;
use App\Dosen;
class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->storeJadwal([
            'kd_kelas' => 'D4A2016',
            'kd_hari' => '1',
            'kd_sesi_mulai' => '1',
            'kd_sesi_berakhir' => '10',
            'kd_ruang' => 'D224',
            'kd_matakuliah' => '16TIN8044',
            'kd_dosen_pengajar' => 'KO003N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D4A2016',
            'kd_hari' => '2',
            'kd_sesi_mulai' => '1',
            'kd_sesi_berakhir' => '2',
            'kd_ruang' => 'D224',
            'kd_matakuliah' => '16TIN8053',
            'kd_dosen_pengajar' => 'KO076N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D4A2016',
            'kd_hari' => '2',
            'kd_sesi_mulai' => '3',
            'kd_sesi_berakhir' => '5',
            'kd_ruang' => 'D224',
            'kd_matakuliah' => '16TIN8053',
            'kd_dosen_pengajar' => 'KO076N',
            'jenis_perkuliahan' => 'PR'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D4A2016',
            'kd_hari' => '2',
            'kd_sesi_mulai' => '6',
            'kd_sesi_berakhir' => '7',
            'kd_ruang' => 'D224',
            'kd_matakuliah' => '16TIN8032',
            'kd_dosen_pengajar' => 'KO045N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D4A2016',
            'kd_hari' => '4',
            'kd_sesi_mulai' => '4',
            'kd_sesi_berakhir' => '6',
            'kd_ruang' => 'D217',
            'kd_matakuliah' => '16KI38022',
            'kd_dosen_pengajar' => 'KO057N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D4A2016',
            'kd_hari' => '4',
            'kd_sesi_mulai' => '7',
            'kd_sesi_berakhir' => '8',
            'kd_ruang' => 'D217',
            'kd_matakuliah' => '16TIN8012',
            'kd_dosen_pengajar' => 'KO005N',
            'jenis_perkuliahan' => 'PR'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D4A2016',
            'kd_hari' => '5',
            'kd_sesi_mulai' => '9',
            'kd_sesi_berakhir' => '11',
            'kd_ruang' => 'D224',
            'kd_matakuliah' => '16TIN8044',
            'kd_dosen_pengajar' => 'KO003N',
            'jenis_perkuliahan' => 'PR'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D4A2017',
            'kd_hari' => '1',
            'kd_sesi_mulai' => '1',
            'kd_sesi_berakhir' => '2',
            'kd_ruang' => 'D223',
            'kd_matakuliah' => '16TIN6043',
            'kd_dosen_pengajar' => 'KO002N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D4A2017',
            'kd_hari' => '1',
            'kd_sesi_mulai' => '3',
            'kd_sesi_berakhir' => '4',
            'kd_ruang' => 'D217',
            'kd_matakuliah' => '16TIN6023',
            'kd_dosen_pengajar' => 'KO012N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D4A2017',
            'kd_hari' => '1',
            'kd_sesi_mulai' => '5',
            'kd_sesi_berakhir' => '7',
            'kd_ruang' => 'D102',
            'kd_matakuliah' => '16TIN6023',
            'kd_dosen_pengajar' => 'KO021N',
            'jenis_perkuliahan' => 'PR'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D4A2017',
            'kd_hari' => '2',
            'kd_sesi_mulai' => '1',
            'kd_sesi_berakhir' => '2',
            'kd_ruang' => 'D223',
            'kd_matakuliah' => '16TIN6013',
            'kd_dosen_pengajar' => 'KO003N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D4A2017',
            'kd_hari' => '2',
            'kd_sesi_mulai' => '3',
            'kd_sesi_berakhir' => '5',
            'kd_ruang' => 'D223',
            'kd_matakuliah' => '16TIN6013',
            'kd_dosen_pengajar' => 'KO003N',
            'jenis_perkuliahan' => 'PR'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D4A2017',
            'kd_hari' => '3',
            'kd_sesi_mulai' => '1',
            'kd_sesi_berakhir' => '3',
            'kd_ruang' => 'D224',
            'kd_matakuliah' => '16TIN6073',
            'kd_dosen_pengajar' => 'KO019N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D4A2017',
            'kd_hari' => '3',
            'kd_sesi_mulai' => '4',
            'kd_sesi_berakhir' => '5',
            'kd_ruang' => 'D224',
            'kd_matakuliah' => '16JTK6032',
            'kd_dosen_pengajar' => 'KO075N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D4A2017',
            'kd_hari' => '3',
            'kd_sesi_mulai' => '7',
            'kd_sesi_berakhir' => '9',
            'kd_ruang' => 'D106',
            'kd_matakuliah' => '16TIN6043',
            'kd_dosen_pengajar' => 'KO045N',
            'jenis_perkuliahan' => 'PR'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D4A2017',
            'kd_hari' => '4',
            'kd_sesi_mulai' => '3',
            'kd_sesi_berakhir' => '3',
            'kd_ruang' => 'D102',
            'kd_matakuliah' => '16TIN6063',
            'kd_dosen_pengajar' => 'KO007N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D4A2017',
            'kd_hari' => '4',
            'kd_sesi_mulai' => '4',
            'kd_sesi_berakhir' => '9',
            'kd_ruang' => 'D102',
            'kd_matakuliah' => '16TIN6063',
            'kd_dosen_pengajar' => 'KO007N',
            'jenis_perkuliahan' => 'PR'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D4A2017',
            'kd_hari' => '5',
            'kd_sesi_mulai' => '1',
            'kd_sesi_berakhir' => '1',
            'kd_ruang' => 'D106',
            'kd_matakuliah' => '16TIN6053',
            'kd_dosen_pengajar' => 'KO007N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D4A2017',
            'kd_hari' => '5',
            'kd_sesi_mulai' => '2',
            'kd_sesi_berakhir' => '4',
            'kd_ruang' => 'D106',
            'kd_matakuliah' => '16TIN6053',
            'kd_dosen_pengajar' => 'KO007N',
            'jenis_perkuliahan' => 'PR'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D4A2017',
            'kd_hari' => '5',
            'kd_sesi_mulai' => '7',
            'kd_sesi_berakhir' => '9',
            'kd_ruang' => 'D106',
            'kd_matakuliah' => '16TIN6053',
            'kd_dosen_pengajar' => 'KO007N',
            'jenis_perkuliahan' => 'PR'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D4A2018',
            'kd_hari' => '1',
            'kd_sesi_mulai' => '1',
            'kd_sesi_berakhir' => '2',
            'kd_ruang' => 'D112',
            'kd_matakuliah' => '16TIN4024',
            'kd_dosen_pengajar' => 'KO012N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D4A2018',
            'kd_hari' => '1',
            'kd_sesi_mulai' => '3',
            'kd_sesi_berakhir' => '4',
            'kd_ruang' => 'D112',
            'kd_matakuliah' => '16TIN4033',
            'kd_dosen_pengajar' => 'KO021N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D4A2018',
            'kd_hari' => '1',
            'kd_sesi_mulai' => '5',
            'kd_sesi_berakhir' => '6',
            'kd_ruang' => 'D112',
            'kd_matakuliah' => '16TIN4063',
            'kd_dosen_pengajar' => 'KO013N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D4A2018',
            'kd_hari' => '2',
            'kd_sesi_mulai' => '1',
            'kd_sesi_berakhir' => '2',
            'kd_ruang' => 'D217',
            'kd_matakuliah' => '16TIN4043',
            'kd_dosen_pengajar' => 'KO019N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D4A2018',
            'kd_hari' => '2',
            'kd_sesi_mulai' => '3',
            'kd_sesi_berakhir' => '3',
            'kd_ruang' => 'D102',
            'kd_matakuliah' => '16TIN4053',
            'kd_dosen_pengajar' => 'KO012N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D4A2018',
            'kd_hari' => '2',
            'kd_sesi_mulai' => '4',
            'kd_sesi_berakhir' => '9',
            'kd_ruang' => 'D102',
            'kd_matakuliah' => '16TIN4053',
            'kd_dosen_pengajar' => 'KO012N',
            'jenis_perkuliahan' => 'PR'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D4A2018',
            'kd_hari' => '3',
            'kd_sesi_mulai' => '1',
            'kd_sesi_berakhir' => '3',
            'kd_ruang' => 'D102',
            'kd_matakuliah' => '16TIN4033',
            'kd_dosen_pengajar' => 'KO021N',
            'jenis_perkuliahan' => 'PR'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D4A2018',
            'kd_hari' => '3',
            'kd_sesi_mulai' => '4',
            'kd_sesi_berakhir' => '5',
            'kd_ruang' => 'D217',
            'kd_matakuliah' => '16KU34052',
            'kd_dosen_pengajar' => 'KO070N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D4A2018',
            'kd_hari' => '3',
            'kd_sesi_mulai' => '7',
            'kd_sesi_berakhir' => '9',
            'kd_ruang' => 'D102',
            'kd_matakuliah' => '16TIN4014',
            'kd_dosen_pengajar' => 'KO007N',
            'jenis_perkuliahan' => 'PR'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D4A2018',
            'kd_hari' => '4',
            'kd_sesi_mulai' => '2',
            'kd_sesi_berakhir' => '4',
            'kd_ruang' => 'D112',
            'kd_matakuliah' => '16TIN4014',
            'kd_dosen_pengajar' => 'KO009N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D4A2018',
            'kd_hari' => '4',
            'kd_sesi_mulai' => '5',
            'kd_sesi_berakhir' => '10',
            'kd_ruang' => 'D112',
            'kd_matakuliah' => '16TIN4024',
            'kd_dosen_pengajar' => 'KO012N',
            'jenis_perkuliahan' => 'PR'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D4A2018',
            'kd_hari' => '5',
            'kd_sesi_mulai' => '1',
            'kd_sesi_berakhir' => '3',
            'kd_ruang' => 'D102',
            'kd_matakuliah' => '16TIN4043',
            'kd_dosen_pengajar' => 'KO017N',
            'jenis_perkuliahan' => 'PR'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D4A2018',
            'kd_hari' => '5',
            'kd_sesi_mulai' => '7',
            'kd_sesi_berakhir' => '9',
            'kd_ruang' => 'D102',
            'kd_matakuliah' => '16TIN4063',
            'kd_dosen_pengajar' => 'KO013N',
            'jenis_perkuliahan' => 'PR'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D4B2019',
            'kd_hari' => '1',
            'kd_sesi_mulai' => '1',
            'kd_sesi_berakhir' => '10',
            'kd_ruang' => 'D115',
            'kd_matakuliah' => '16TIN2043',
            'kd_dosen_pengajar' => 'KO060N',
            'jenis_perkuliahan' => 'PR'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D4B2019',
            'kd_hari' => '2',
            'kd_sesi_mulai' => '1',
            'kd_sesi_berakhir' => '3',
            'kd_ruang' => 'D111',
            'kd_matakuliah' => '16TIN2054',
            'kd_dosen_pengajar' => 'KO059N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D4B2019',
            'kd_hari' => '2',
            'kd_sesi_mulai' => '4',
            'kd_sesi_berakhir' => '6',
            'kd_ruang' => 'D106',
            'kd_matakuliah' => '16TIN2054',
            'kd_dosen_pengajar' => 'KO061N',
            'jenis_perkuliahan' => 'PR'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D4B2019',
            'kd_hari' => '3',
            'kd_sesi_mulai' => '1',
            'kd_sesi_berakhir' => '2',
            'kd_ruang' => 'D111',
            'kd_matakuliah' => '16TIN2074',
            'kd_dosen_pengajar' => 'KO001N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D4B2019',
            'kd_hari' => '3',
            'kd_sesi_mulai' => '3',
            'kd_sesi_berakhir' => '4',
            'kd_ruang' => 'D111',
            'kd_matakuliah' => '16KI22022',
            'kd_dosen_pengajar' => 'KO075N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D4B2019',
            'kd_hari' => '3',
            'kd_sesi_mulai' => '5',
            'kd_sesi_berakhir' => '6',
            'kd_ruang' => 'D111',
            'kd_matakuliah' => '16KU12062',
            'kd_dosen_pengajar' => 'KO069N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D4B2019',
            'kd_hari' => '3',
            'kd_sesi_mulai' => '7',
            'kd_sesi_berakhir' => '8',
            'kd_ruang' => 'D111',
            'kd_matakuliah' => '16TIN2032',
            'kd_dosen_pengajar' => 'KO056N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D4B2019',
            'kd_hari' => '4',
            'kd_sesi_mulai' => '1',
            'kd_sesi_berakhir' => '6',
            'kd_ruang' => 'D107',
            'kd_matakuliah' => '16TIN2074',
            'kd_dosen_pengajar' => 'KO002N',
            'jenis_perkuliahan' => 'PR'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D4B2019',
            'kd_hari' => '5',
            'kd_sesi_mulai' => '1',
            'kd_sesi_berakhir' => '3',
            'kd_ruang' => 'D111',
            'kd_matakuliah' => '16TIN2013',
            'kd_dosen_pengajar' => 'KO016N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D4A2019',
            'kd_hari' => '1',
            'kd_sesi_mulai' => '1',
            'kd_sesi_berakhir' => '10',
            'kd_ruang' => 'D116',
            'kd_matakuliah' => '16TIN2043',
            'kd_dosen_pengajar' => 'KO023N',
            'jenis_perkuliahan' => 'PR'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D4A2019',
            'kd_hari' => '2',
            'kd_sesi_mulai' => '1',
            'kd_sesi_berakhir' => '3',
            'kd_ruang' => 'D112',
            'kd_matakuliah' => '16TIN2013',
            'kd_dosen_pengajar' => 'KO016N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D4A2019',
            'kd_hari' => '2',
            'kd_sesi_mulai' => '4',
            'kd_sesi_berakhir' => '6',
            'kd_ruang' => 'D112',
            'kd_matakuliah' => '16TIN2054',
            'kd_dosen_pengajar' => 'KO059N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D4A2019',
            'kd_hari' => '3',
            'kd_sesi_mulai' => '1',
            'kd_sesi_berakhir' => '2',
            'kd_ruang' => 'D112',
            'kd_matakuliah' => '16KU12062',
            'kd_dosen_pengajar' => 'KO072N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D4A2019',
            'kd_hari' => '3',
            'kd_sesi_mulai' => '3',
            'kd_sesi_berakhir' => '4',
            'kd_ruang' => 'D112',
            'kd_matakuliah' => '16TIN2074',
            'kd_dosen_pengajar' => 'KO001N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D4A2019',
            'kd_hari' => '3',
            'kd_sesi_mulai' => '5',
            'kd_sesi_berakhir' => '6',
            'kd_ruang' => 'D112',
            'kd_matakuliah' => '16KI22022',
            'kd_dosen_pengajar' => 'KO075N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D4A2019',
            'kd_hari' => '3',
            'kd_sesi_mulai' => '7',
            'kd_sesi_berakhir' => '8',
            'kd_ruang' => 'D112',
            'kd_matakuliah' => '16TIN2032',
            'kd_dosen_pengajar' => 'KO057N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D4A2019',
            'kd_hari' => '5',
            'kd_sesi_mulai' => '1',
            'kd_sesi_berakhir' => '9',
            'kd_ruang' => 'D107',
            'kd_matakuliah' => '16TIN2074',
            'kd_dosen_pengajar' => 'KO002N',
            'jenis_perkuliahan' => 'PR'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D3A2019',
            'kd_hari' => '1',
            'kd_sesi_mulai' => '1',
            'kd_sesi_berakhir' => '2',
            'kd_ruang' => 'D105',
            'kd_matakuliah' => '16TKO2032',
            'kd_dosen_pengajar' => 'KO016N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D3A2019',
            'kd_hari' => '1',
            'kd_sesi_mulai' => '3',
            'kd_sesi_berakhir' => '4',
            'kd_ruang' => 'D105',
            'kd_matakuliah' => '16TKO2044',
            'kd_dosen_pengajar' => 'KO001N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D3A2019',
            'kd_hari' => '1',
            'kd_sesi_mulai' => '5',
            'kd_sesi_berakhir' => '10',
            'kd_ruang' => 'D107',
            'kd_matakuliah' => '16TKO2044',
            'kd_dosen_pengajar' => 'KO009N',
            'jenis_perkuliahan' => 'PR'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D3A2019',
            'kd_hari' => '2',
            'kd_sesi_mulai' => '1',
            'kd_sesi_berakhir' => '2',
            'kd_ruang' => 'D108',
            'kd_matakuliah' => '16TKO2053',
            'kd_dosen_pengajar' => 'KO022N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D3A2019',
            'kd_hari' => '3',
            'kd_sesi_mulai' => '3',
            'kd_sesi_berakhir' => '4',
            'kd_ruang' => 'D105',
            'kd_matakuliah' => '16KU12022',
            'kd_dosen_pengajar' => 'KO077N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D3A2019',
            'kd_hari' => '3',
            'kd_sesi_mulai' => '5',
            'kd_sesi_berakhir' => '6',
            'kd_ruang' => 'D105',
            'kd_matakuliah' => '16KI22012',
            'kd_dosen_pengajar' => 'KO071N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D3A2019',
            'kd_hari' => '3',
            'kd_sesi_mulai' => '7',
            'kd_sesi_berakhir' => '8',
            'kd_ruang' => 'D105',
            'kd_matakuliah' => '16TKO2062',
            'kd_dosen_pengajar' => 'KO018N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D3A2019',
            'kd_hari' => '4',
            'kd_sesi_mulai' => '3',
            'kd_sesi_berakhir' => '12',
            'kd_ruang' => 'D115',
            'kd_matakuliah' => '16TKO2073',
            'kd_dosen_pengajar' => 'KO023N',
            'jenis_perkuliahan' => 'PR'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D3A2019',
            'kd_hari' => '5',
            'kd_sesi_mulai' => '1',
            'kd_sesi_berakhir' => '3',
            'kd_ruang' => 'D105',
            'kd_matakuliah' => '16TKO2053',
            'kd_dosen_pengajar' => 'KO065N',
            'jenis_perkuliahan' => 'PR'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D3B2019',
            'kd_hari' => '1',
            'kd_sesi_mulai' => '1',
            'kd_sesi_berakhir' => '2',
            'kd_ruang' => 'D108',
            'kd_matakuliah' => '16TKO2044',
            'kd_dosen_pengajar' => 'KO001N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D3B2019',
            'kd_hari' => '1',
            'kd_sesi_mulai' => '3',
            'kd_sesi_berakhir' => '4',
            'kd_ruang' => 'D108',
            'kd_matakuliah' => '16TKO2032',
            'kd_dosen_pengajar' => 'KO016N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D3B2019',
            'kd_hari' => '2',
            'kd_sesi_mulai' => '3',
            'kd_sesi_berakhir' => '4',
            'kd_ruang' => 'D108',
            'kd_matakuliah' => '16TKO2053',
            'kd_dosen_pengajar' => 'KO022N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D3B2019',
            'kd_hari' => '2',
            'kd_sesi_mulai' => '5',
            'kd_sesi_berakhir' => '10',
            'kd_ruang' => 'D107',
            'kd_matakuliah' => '16TKO2044',
            'kd_dosen_pengajar' => 'KO009N',
            'jenis_perkuliahan' => 'PR'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D3B2019',
            'kd_hari' => '3',
            'kd_sesi_mulai' => '1',
            'kd_sesi_berakhir' => '2',
            'kd_ruang' => 'D108',
            'kd_matakuliah' => '16TKO2062',
            'kd_dosen_pengajar' => 'KO018N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D3B2019',
            'kd_hari' => '3',
            'kd_sesi_mulai' => '2',
            'kd_sesi_berakhir' => '4',
            'kd_ruang' => 'D108',
            'kd_matakuliah' => '16KI22012',
            'kd_dosen_pengajar' => 'KO071N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D3B2019',
            'kd_hari' => '3',
            'kd_sesi_mulai' => '7',
            'kd_sesi_berakhir' => '8',
            'kd_ruang' => 'D108',
            'kd_matakuliah' => '16KU12022',
            'kd_dosen_pengajar' => 'KO077N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D3B2019',
            'kd_hari' => '4',
            'kd_sesi_mulai' => '3',
            'kd_sesi_berakhir' => '12',
            'kd_ruang' => 'D116',
            'kd_matakuliah' => '16TKO2073',
            'kd_dosen_pengajar' => 'KO013N',
            'jenis_perkuliahan' => 'PR'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D3B2019',
            'kd_hari' => '5',
            'kd_sesi_mulai' => '7',
            'kd_sesi_berakhir' => '9',
            'kd_ruang' => 'D108',
            'kd_matakuliah' => '16TKO2053',
            'kd_dosen_pengajar' => 'KO065N',
            'jenis_perkuliahan' => 'PR'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D3A2018',
            'kd_hari' => '1',
            'kd_sesi_mulai' => '1',
            'kd_sesi_berakhir' => '2',
            'kd_ruang' => 'D219',
            'kd_matakuliah' => '16TKO4024',
            'kd_dosen_pengajar' => 'KO006N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D3A2018',
            'kd_hari' => '1',
            'kd_sesi_mulai' => '3',
            'kd_sesi_berakhir' => '8',
            'kd_ruang' => 'D219',
            'kd_matakuliah' => '16TKO4024',
            'kd_dosen_pengajar' => 'KO006N',
            'jenis_perkuliahan' => 'PR'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D3A2018',
            'kd_hari' => '2',
            'kd_sesi_mulai' => '3',
            'kd_sesi_berakhir' => '3',
            'kd_ruang' => 'D115',
            'kd_matakuliah' => '16TKO4063',
            'kd_dosen_pengajar' => 'KO067N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D3A2018',
            'kd_hari' => '2',
            'kd_sesi_mulai' => '4',
            'kd_sesi_berakhir' => '9',
            'kd_ruang' => 'D115',
            'kd_matakuliah' => '16TKO4063',
            'kd_dosen_pengajar' => 'KO067N',
            'jenis_perkuliahan' => 'PR'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D3A2018',
            'kd_hari' => '3',
            'kd_sesi_mulai' => '1',
            'kd_sesi_berakhir' => '2',
            'kd_ruang' => 'D219',
            'kd_matakuliah' => '16KU34052',
            'kd_dosen_pengajar' => 'KO016N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D3A2018',
            'kd_hari' => '3',
            'kd_sesi_mulai' => '3',
            'kd_sesi_berakhir' => '4',
            'kd_ruang' => 'D105',
            'kd_matakuliah' => '16TKO4014',
            'kd_dosen_pengajar' => 'KO045N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D3A2018',
            'kd_hari' => '3',
            'kd_sesi_mulai' => '7',
            'kd_sesi_berakhir' => '9',
            'kd_ruang' => 'D219',
            'kd_matakuliah' => '16TKO4033',
            'kd_dosen_pengajar' => 'KO008N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D3A2018',
            'kd_hari' => '4',
            'kd_sesi_mulai' => '1',
            'kd_sesi_berakhir' => '1',
            'kd_ruang' => 'D224',
            'kd_matakuliah' => '16TKO4043',
            'kd_dosen_pengajar' => 'KO062N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D3A2018',
            'kd_hari' => '4',
            'kd_sesi_mulai' => '2',
            'kd_sesi_berakhir' => '7',
            'kd_ruang' => 'D224',
            'kd_matakuliah' => '16TKO4043',
            'kd_dosen_pengajar' => 'KO061N',
            'jenis_perkuliahan' => 'PR'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D3A2018',
            'kd_hari' => '5',
            'kd_sesi_mulai' => '1',
            'kd_sesi_berakhir' => '4',
            'kd_ruang' => 'D116',
            'kd_matakuliah' => '16TKO4014',
            'kd_dosen_pengajar' => 'KO070N',
            'jenis_perkuliahan' => 'PR'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D3A2018',
            'kd_hari' => '5',
            'kd_sesi_mulai' => '7',
            'kd_sesi_berakhir' => '8',
            'kd_ruang' => 'D116',
            'kd_matakuliah' => '16TKO4014',
            'kd_dosen_pengajar' => 'KO070N',
            'jenis_perkuliahan' => 'PR'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D3B2018',
            'kd_hari' => '1',
            'kd_sesi_mulai' => '3',
            'kd_sesi_berakhir' => '3',
            'kd_ruang' => 'D106',
            'kd_matakuliah' => '16TKO4043',
            'kd_dosen_pengajar' => 'KO072N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D3B2018',
            'kd_hari' => '1',
            'kd_sesi_mulai' => '4',
            'kd_sesi_berakhir' => '9',
            'kd_ruang' => 'D106',
            'kd_matakuliah' => '16TKO4043',
            'kd_dosen_pengajar' => 'KO061N',
            'jenis_perkuliahan' => 'PR'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D3B2018',
            'kd_hari' => '2',
            'kd_sesi_mulai' => '3',
            'kd_sesi_berakhir' => '3',
            'kd_ruang' => 'D116',
            'kd_matakuliah' => '16TKO4063',
            'kd_dosen_pengajar' => 'KO002N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D3B2018',
            'kd_hari' => '2',
            'kd_sesi_mulai' => '4',
            'kd_sesi_berakhir' => '9',
            'kd_ruang' => 'D116',
            'kd_matakuliah' => '16TKO4063',
            'kd_dosen_pengajar' => 'KO002N',
            'jenis_perkuliahan' => 'PR'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D3B2018',
            'kd_hari' => '3',
            'kd_sesi_mulai' => '1',
            'kd_sesi_berakhir' => '2',
            'kd_ruang' => 'D217',
            'kd_matakuliah' => '16TKO4014',
            'kd_dosen_pengajar' => 'KO045N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D3B2018',
            'kd_hari' => '3',
            'kd_sesi_mulai' => '3',
            'kd_sesi_berakhir' => '4',
            'kd_ruang' => 'D217',
            'kd_matakuliah' => '16KU34052',
            'kd_dosen_pengajar' => 'KO016N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D3B2018',
            'kd_hari' => '3',
            'kd_sesi_mulai' => '7',
            'kd_sesi_berakhir' => '9',
            'kd_ruang' => 'D217',
            'kd_matakuliah' => '16TKO4033',
            'kd_dosen_pengajar' => 'KO075N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D3B2018',
            'kd_hari' => '4',
            'kd_sesi_mulai' => '1',
            'kd_sesi_berakhir' => '6',
            'kd_ruang' => 'D106',
            'kd_matakuliah' => '16TKO4014',
            'kd_dosen_pengajar' => 'KO064N',
            'jenis_perkuliahan' => 'PR'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D3B2018',
            'kd_hari' => '5',
            'kd_sesi_mulai' => '1',
            'kd_sesi_berakhir' => '2',
            'kd_ruang' => 'D115',
            'kd_matakuliah' => '16TKO4024',
            'kd_dosen_pengajar' => 'KO006N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D3B2018',
            'kd_hari' => '5',
            'kd_sesi_mulai' => '3',
            'kd_sesi_berakhir' => '9',
            'kd_ruang' => 'D115',
            'kd_matakuliah' => '16TKO4024',
            'kd_dosen_pengajar' => 'KO006N',
            'jenis_perkuliahan' => 'PR'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D3A2017',
            'kd_hari' => '1',
            'kd_sesi_mulai' => '3',
            'kd_sesi_berakhir' => '3',
            'kd_ruang' => 'D223',
            'kd_matakuliah' => '16TKO6043',
            'kd_dosen_pengajar' => 'KO045N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D3A2017',
            'kd_hari' => '1',
            'kd_sesi_mulai' => '4',
            'kd_sesi_berakhir' => '9',
            'kd_ruang' => 'D223',
            'kd_matakuliah' => '16TKO6043',
            'kd_dosen_pengajar' => 'KO045N',
            'jenis_perkuliahan' => 'PR'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D3A2017',
            'kd_hari' => '3',
            'kd_sesi_mulai' => '1',
            'kd_sesi_berakhir' => '2',
            'kd_ruang' => 'D223',
            'kd_matakuliah' => '16TKO6022',
            'kd_dosen_pengajar' => 'KO008N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D3A2017',
            'kd_hari' => '3',
            'kd_sesi_mulai' => '3',
            'kd_sesi_berakhir' => '4',
            'kd_ruang' => 'D223',
            'kd_matakuliah' => '16JTK6012',
            'kd_dosen_pengajar' => 'KO063N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D3A2017',
            'kd_hari' => '3',
            'kd_sesi_mulai' => '9',
            'kd_sesi_berakhir' => '10',
            'kd_ruang' => 'D223',
            'kd_matakuliah' => '16TKO6032',
            'kd_dosen_pengajar' => 'KO005N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D3A2017',
            'kd_hari' => '4',
            'kd_sesi_mulai' => '1',
            'kd_sesi_berakhir' => '10',
            'kd_ruang' => 'D223',
            'kd_matakuliah' => '16TKO6054',
            'kd_dosen_pengajar' => 'KO008N',
            'jenis_perkuliahan' => 'PR'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D3A2017',
            'kd_hari' => '5',
            'kd_sesi_mulai' => '9',
            'kd_sesi_berakhir' => '11',
            'kd_ruang' => 'D223',
            'kd_matakuliah' => '16TKO6054',
            'kd_dosen_pengajar' => 'KO008N',
            'jenis_perkuliahan' => 'PR'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D3B2017',
            'kd_hari' => '2',
            'kd_sesi_mulai' => '1',
            'kd_sesi_berakhir' => '1',
            'kd_ruang' => 'D219',
            'kd_matakuliah' => '16TKO6043',
            'kd_dosen_pengajar' => 'KO017N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D3B2017',
            'kd_hari' => '2',
            'kd_sesi_mulai' => '2',
            'kd_sesi_berakhir' => '7',
            'kd_ruang' => 'D219',
            'kd_matakuliah' => '16TKO6043',
            'kd_dosen_pengajar' => 'KO017N',
            'jenis_perkuliahan' => 'PR'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D3B2017',
            'kd_hari' => '3',
            'kd_sesi_mulai' => '3',
            'kd_sesi_berakhir' => '4',
            'kd_ruang' => 'D219',
            'kd_matakuliah' => '16TKO6022',
            'kd_dosen_pengajar' => 'KO008N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D3B2017',
            'kd_hari' => '3',
            'kd_sesi_mulai' => '5',
            'kd_sesi_berakhir' => '6',
            'kd_ruang' => 'D219',
            'kd_matakuliah' => '16JTK6012',
            'kd_dosen_pengajar' => 'KO063N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D3B2017',
            'kd_hari' => '3',
            'kd_sesi_mulai' => '7',
            'kd_sesi_berakhir' => '8',
            'kd_ruang' => 'D223',
            'kd_matakuliah' => '16TKO6032',
            'kd_dosen_pengajar' => 'KO005N',
            'jenis_perkuliahan' => 'TE'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D3B2017',
            'kd_hari' => '4',
            'kd_sesi_mulai' => '1',
            'kd_sesi_berakhir' => '10',
            'kd_ruang' => 'D219',
            'kd_matakuliah' => '16TKO6054',
            'kd_dosen_pengajar' => 'KO018N',
            'jenis_perkuliahan' => 'PR'
        ]);
        
        
        $this->storeJadwal([
            'kd_kelas' => 'D3B2017',
            'kd_hari' => '5',
            'kd_sesi_mulai' => '9',
            'kd_sesi_berakhir' => '11',
            'kd_ruang' => 'D219',
            'kd_matakuliah' => '16TKO6054',
            'kd_dosen_pengajar' => 'KO018N',
            'jenis_perkuliahan' => 'PR'
        ]);
        
    }

    public function storeJadwal($data)
    {
        $jadwal = new Jadwal;
        $temp = Jadwal::all()->last();
        $kd_jadwal = 'Jadwal0001';
        if($temp){
            $kd_jadwal = ++$temp->kd_jadwal; 
        }
        $kelas = Kelas::find($data['kd_kelas']);
        $hari = Hari::find($data['kd_hari']);
        $kd_sesi_mulai = Sesi::find($data['kd_sesi_mulai']);
        $kd_sesi_berakhir = Sesi::find($data['kd_sesi_berakhir']);
        $kd_ruang = Ruang::find($data['kd_ruang']);
        $kd_matakuliah = Matakuliah::find($data['kd_matakuliah']);
        $kd_dosen_pengajar = Dosen::find($data['kd_dosen_pengajar']);
        if($data['jenis_perkuliahan'] == 'TE'){
            $jenis_perkuliahan = 'Teori';
        }else $jenis_perkuliahan = 'Praktek';

        // ASSIGN DATA
        $jadwal->kd_jadwal = $kd_jadwal;
        $jadwal->kelas()->associate($kelas);
        $jadwal->hari()->associate($hari);
        $jadwal->sesiMulai()->associate($kd_sesi_mulai);
        $jadwal->sesiBerakhir()->associate($kd_sesi_berakhir);
        $jadwal->ruang()->associate($kd_ruang);
        $jadwal->matakuliah()->associate($kd_matakuliah);
        $jadwal->dosen()->associate($kd_dosen_pengajar);
        $jadwal->jenis_perkuliahan = $jenis_perkuliahan;
        $jadwal->save();
    }
}
