<?php

use Illuminate\Database\Seeder;
use App\Hari;

class HariSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Hari::create([
            'kd_hari' => '1',
            'nama_hari' => 'Senin'
        ]);
        Hari::create([
            'kd_hari' => '2',
            'nama_hari' => 'Selasa'
        ]);
        Hari::create([
            'kd_hari' => '3',
            'nama_hari' => 'Rabu'
        ]);
        Hari::create([
            'kd_hari' => '4',
            'nama_hari' => 'Kamis'
        ]);
        Hari::create([
            'kd_hari' => '5',
            'nama_hari' => 'Jumat'
        ]);
    }
}
