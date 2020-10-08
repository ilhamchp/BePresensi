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
            'jam_berakhir' => '15:30:00'
        ]);
        
        Sesi::create([
            'kd_sesi' => '10',
            'jam_mulai' => '15:50:01',
            'jam_berakhir' => '16:40:00'
        ]);

        Sesi::create([
            'kd_sesi' => '11',
            'jam_mulai' => '16:40:01',
            'jam_berakhir' => '17:30:00'
        ]);

        Sesi::create([
            'kd_sesi' => '12',
            'jam_mulai' => '17:30:01',
            'jam_berakhir' => '18:20:00'
        ]);

        Sesi::create([
            'kd_sesi' => '13',
            'jam_mulai' => '18:20:01',
            'jam_berakhir' => '19:10:00'
        ]);

        Sesi::create([
            'kd_sesi' => '14',
            'jam_mulai' => '19:10:01',
            'jam_berakhir' => '20:00:00'
        ]);

        Sesi::create([
            'kd_sesi' => '15',
            'jam_mulai' => '20:00:01',
            'jam_berakhir' => '20:50:00'
        ]);

        Sesi::create([
            'kd_sesi' => '16',
            'jam_mulai' => '20:50:01',
            'jam_berakhir' => '21:40:00'
        ]);

        Sesi::create([
            'kd_sesi' => '17',
            'jam_mulai' => '21:40:01',
            'jam_berakhir' => '22:30:00'
        ]);

        Sesi::create([
            'kd_sesi' => '18',
            'jam_mulai' => '22:30:01',
            'jam_berakhir' => '23:20:00'
        ]);

        Sesi::create([
            'kd_sesi' => '19',
            'jam_mulai' => '23:20:01',
            'jam_berakhir' => '23:59:59'
        ]);

        Sesi::create([
            'kd_sesi' => '20',
            'jam_mulai' => '00:00:01',
            'jam_berakhir' => '00:50:00'
        ]);

        Sesi::create([
            'kd_sesi' => '21',
            'jam_mulai' => '00:50:01',
            'jam_berakhir' => '01:40:00'
        ]);


        Sesi::create([
            'kd_sesi' => '22',
            'jam_mulai' => '01:40:01',
            'jam_berakhir' => '02:30:00'
        ]);

        Sesi::create([
            'kd_sesi' => '23',
            'jam_mulai' => '02:30:01',
            'jam_berakhir' => '03:20:00'
        ]);

        Sesi::create([
            'kd_sesi' => '24',
            'jam_mulai' => '03:20:01',
            'jam_berakhir' => '04:10:00'
        ]);

        Sesi::create([
            'kd_sesi' => '25',
            'jam_mulai' => '04:10:01',
            'jam_berakhir' => '05:00:00'
        ]);
        Sesi::create([
            'kd_sesi' => '26',
            'jam_mulai' => '05:00:01',
            'jam_berakhir' => '05:50:00'
        ]);
    }
}
