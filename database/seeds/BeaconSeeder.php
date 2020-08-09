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
            'mac_address' => '58:33:f2:14:e5:1e',
            'major' => '0x2794',
            'minor' => '0x6666'
        ]);
        
        Beacon::create([
            'kd_beacon' => 'CB002',
            'mac_address' => '39:82:01:79:53:c3',
            'major' => '0x4425',
            'minor' => '0x0879'
        ]);
        
        Beacon::create([
            'kd_beacon' => 'CB003',
            'mac_address' => '47:96:94:bb:87:c3',
            'major' => '0x5085',
            'minor' => '0x5308'
        ]);
        
        Beacon::create([
            'kd_beacon' => 'CB004',
            'mac_address' => 'de:8e:8d:80:9c:55',
            'major' => '0x8576',
            'minor' => '0x5410'
        ]);
        
        Beacon::create([
            'kd_beacon' => 'CB005',
            'mac_address' => '47:ea:d9:ab:a9:d1',
            'major' => '0x5946',
            'minor' => '0x3201'
        ]);
        
        Beacon::create([
            'kd_beacon' => 'CB006',
            'mac_address' => 'd8:b2:95:23:ac:b6',
            'major' => '0x2927',
            'minor' => '0x9139'
        ]);
        
        Beacon::create([
            'kd_beacon' => 'CB007',
            'mac_address' => 'a9:12:0d:d1:fe:24',
            'major' => '0x6133',
            'minor' => '0x6142'
        ]);
        
        Beacon::create([
            'kd_beacon' => 'CB008',
            'mac_address' => '26:0c:90:eb:1e:fb',
            'major' => '0x7332',
            'minor' => '0x6378'
        ]);
        
        Beacon::create([
            'kd_beacon' => 'CB009',
            'mac_address' => '8b:fe:65:d4:1b:a9',
            'major' => '0x2062',
            'minor' => '0x7551'
        ]);
        
        Beacon::create([
            'kd_beacon' => 'CB010',
            'mac_address' => '82:42:f6:ef:36:92',
            'major' => '0x6083',
            'minor' => '0x4320'
        ]);
        
        Beacon::create([
            'kd_beacon' => 'CB011',
            'mac_address' => '1f:af:8c:d8:c9:bc',
            'major' => '0x8252',
            'minor' => '0x8335'
        ]);
        
        Beacon::create([
            'kd_beacon' => 'CB012',
            'mac_address' => '61:03:5c:66:a3:34',
            'major' => '0x6421',
            'minor' => '0x2663'
        ]);
        
        Beacon::create([
            'kd_beacon' => 'CB013',
            'mac_address' => '16:48:fb:dd:ba:81',
            'major' => '0x0967',
            'minor' => '0x0806'
        ]);
        
        Beacon::create([
            'kd_beacon' => 'CB014',
            'mac_address' => '95:cc:20:40:5b:f9',
            'major' => '0x0712',
            'minor' => '0x0486'
        ]);

    }
}
