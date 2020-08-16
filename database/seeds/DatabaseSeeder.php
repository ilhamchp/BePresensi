<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            StaffTataUsahaSeeder::class,
            DosenSeeder::class,
            MatakuliahSeeder::class,
            HariSeeder::class,
            StatusSuratSeeder::class,
            StatusPresensiSeeder::class,
            SesiSeeder::class,
            KelasSeeder::class,
            MahasiswaSeeder::class,
            BeaconSeeder::class,
            RuangSeeder::class,
            SuratIzinSeeder::class,
            JadwalSeeder::class,
            BeritaAcaraSeeder::class,
            KehadiranSeeder::class
        ]);
    }
}
