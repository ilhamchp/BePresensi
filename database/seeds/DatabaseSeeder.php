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
        $this->call(StaffTataUsahaSeeder::class);
        $this->call(DosenSeeder::class);
        $this->call(MatakuliahSeeder::class);
        $this->call(HariSeeder::class);
        $this->call(StatusSuratSeeder::class);
        $this->call(StatusPresensiSeeder::class);
        $this->call(SesiSeeder::class);
        $this->call(KelasSeeder::class);
        $this->call(MahasiswaSeeder::class);
    }
}
