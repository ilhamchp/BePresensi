<?php

use Illuminate\Database\Seeder;
use App\Sesi;
class SesiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sesi::create([
            'kd_sesi' => '1',
            'jam_mulai' => '07:00:00',
            'jam_berakhir' => '07:50:00'
        ]);

        Sesi::create([
            'kd_sesi' => '2',
            'jam_mulai' => '07:50:01',
            'jam_berakhir' => '08:40:00'
        ]);

        Sesi::create([
            'kd_sesi' => '3',
            'jam_mulai' => '08:40:01',
            'jam_berakhir' => '09:30:00'
        ]);

        Sesi::create([
            'kd_sesi' => '4',
            'jam_mulai' => '09:30:01',
            'jam_berakhir' => '10:20:00'
        ]);

        Sesi::create([
            'kd_sesi' => '5',
            'jam_mulai' => '10:40:00',
            'jam_berakhir' => '11:30:00'
        ]);

        Sesi::create([
            'kd_sesi' => '6',
            'jam_mulai' => '11:30:01',
            'jam_berakhir' => '12:20:00'
        ]);

        Sesi::create([
            'kd_sesi' => '7',
            'jam_mulai' => '13:00:00',
            'jam_berakhir' => '13:50:00'
        ]);

        Sesi::create([
            'kd_sesi' => '8',
            'jam_mulai' => '13:50:01',
            'jam_berakhir' => '14:40:00'
        ]);

        Sesi::create([
            'kd_sesi' => '9',
            'jam_mulai' => '14:40:01',
            'jam_berakhir' => '15:20:00'
        ]);
        
        Sesi::create([
            'kd_sesi' => '10',
            'jam_mulai' => '15:20:01',
            'jam_berakhir' => '16:10:00'
        ]);

        Sesi::create([
            'kd_sesi' => '11',
            'jam_mulai' => '16:10:01',
            'jam_berakhir' => '17:00:00'
        ]);

        Sesi::create([
            'kd_sesi' => '12',
            'jam_mulai' => '17:00:01',
            'jam_berakhir' => '17:50:00'
        ]);
    }
}
