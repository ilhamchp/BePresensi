<?php

use Illuminate\Database\Seeder;
use App\Beacon;

class BeaconSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Beacon::create([
            'kd_beacon' => 'CB001',
            'mac_address' => 'c36ae031-2b7b-4081-b6d3-f620ce61206e',
            'major' => '94',
            'minor' => '66'
        ]);
        
        Beacon::create([
            'kd_beacon' => 'CB002',
            'mac_address' => 'f43d4927-b295-4d12-bb46-d97d4614c64b',
            'major' => '25',
            'minor' => '79'
        ]);
        
        Beacon::create([
            'kd_beacon' => 'CB003',
            'mac_address' => '42b222d8-0460-4962-a248-eb32de403ed7',
            'major' => '85',
            'minor' => '88'
        ]);
        
        Beacon::create([
            'kd_beacon' => 'CB004',
            'mac_address' => '57cf9f84-4aed-4ef5-a8b4-fabfc1608241',
            'major' => '76',
            'minor' => '10'
        ]);
        
        Beacon::create([
            'kd_beacon' => 'CB005',
            'mac_address' => 'de034c15-7448-41c4-a94b-0f11bd80b668',
            'major' => '46',
            'minor' => '21'
        ]);
        
        Beacon::create([
            'kd_beacon' => 'CB006',
            'mac_address' => '01e470b4-cfea-4f31-acf8-18b97a2db4c5',
            'major' => '27',
            'minor' => '39'
        ]);
        
        Beacon::create([
            'kd_beacon' => 'CB007',
            'mac_address' => '6c29d005-4d9b-4217-942e-92cd08672078',
            'major' => '33',
            'minor' => '42'
        ]);
        
        Beacon::create([
            'kd_beacon' => 'CB008',
            'mac_address' => 'afe15887-c5f3-457c-a277-84f1a3dd5c5d',
            'major' => '32',
            'minor' => '78'
        ]);
        
        Beacon::create([
            'kd_beacon' => 'CB009',
            'mac_address' => '692570eb-df49-4c9e-935c-71fe38961f7e',
            'major' => '62',
            'minor' => '51'
        ]);
        
        Beacon::create([
            'kd_beacon' => 'CB010',
            'mac_address' => '863aaf9d-cebe-4c5e-97cf-6b2d99472f04',
            'major' => '83',
            'minor' => '20'
        ]);
        
        Beacon::create([
            'kd_beacon' => 'CB011',
            'mac_address' => '2905186b-d5f1-4088-a502-355a4f42364f',
            'major' => '52',
            'minor' => '35'
        ]);
        
        // Beacon Koval
        Beacon::create([
            'kd_beacon' => 'CB012',
            'mac_address' => 'CB10023F-A318-3394-4199-A8730C7C1AEC',
            'major' => '222',
            'minor' => '208'
        ]);
        
        Beacon::create([
            'kd_beacon' => 'CB013',
            'mac_address' => '746dc8c9-1115-4d73-8b01-f48b8fa1e44a',
            'major' => '67',
            'minor' => '86'
        ]);
        
        Beacon::create([
            'kd_beacon' => 'CB014',
            'mac_address' => 'f97f8e2c-36d5-426f-8680-7182bf8bdb0e',
            'major' => '12',
            'minor' => '86'
        ]);

    }
}
