<?php

use Illuminate\Database\Seeder;
use App\Ruang;
use App\Beacon;

class RuangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->storeRuang([
            'kd_ruang' => 'D101',
            'nama_ruang' => 'Kelas',
            'kd_beacon' => 'CB001'
        ]);

        $this->storeRuang([
            'kd_ruang' => 'D102',
            'nama_ruang' => 'Lab. MT',
            'kd_beacon' => 'CB002'
        ]);

        $this->storeRuang([
            'kd_ruang' => 'D105',
            'nama_ruang' => 'Kelas',
            'kd_beacon' => 'CB003'
        ]);

        $this->storeRuang([
            'kd_ruang' => 'D106',
            'nama_ruang' => 'Lab. SDB',
            'kd_beacon' => 'CB004'
        ]);

        $this->storeRuang([
            'kd_ruang' => 'D107',
            'nama_ruang' => 'Lab. RPL',
            'kd_beacon' => 'CB005'
        ]);

        $this->storeRuang([
            'kd_ruang' => 'D108',
            'nama_ruang' => 'Kelas',
            'kd_beacon' => 'CB006'
        ]);

        $this->storeRuang([
            'kd_ruang' => 'D111',
            'nama_ruang' => 'Kelas',
            'kd_beacon' => 'CB007'
        ]);

        $this->storeRuang([
            'kd_ruang' => 'D112',
            'nama_ruang' => 'Kelas',
            'kd_beacon' => 'CB008'
        ]);

        $this->storeRuang([
            'kd_ruang' => 'D115',
            'nama_ruang' => 'Lab. ICT-1',
            'kd_beacon' => 'CB009'
        ]);

        $this->storeRuang([
            'kd_ruang' => 'D116',
            'nama_ruang' => 'Lab. ICT-2',
            'kd_beacon' => 'CB010'
        ]);

        $this->storeRuang([
            'kd_ruang' => 'D217',
            'nama_ruang' => 'Kelas',
            'kd_beacon' => 'CB011'
        ]);

        $this->storeRuang([
            'kd_ruang' => 'D219',
            'nama_ruang' => 'Kelas',
            'kd_beacon' => 'CB012'
        ]);

        $this->storeRuang([
            'kd_ruang' => 'D223',
            'nama_ruang' => 'Kelas',
            'kd_beacon' => 'CB013'
        ]);

        $this->storeRuang([
            'kd_ruang' => 'D224',
            'nama_ruang' => 'Kelas',
            'kd_beacon' => 'CB014'
        ]);
    }

    public function storeRuang($data)
    {
        $beacon = Beacon::find($data['kd_beacon']);

        $ruang = new Ruang;
        $ruang->kd_ruang = $data['kd_ruang'];
        $ruang->nama_ruang = $data['nama_ruang'];
        $ruang->beacon()->associate($beacon);
        $ruang->save();
    }
}
