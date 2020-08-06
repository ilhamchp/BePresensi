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
    }
}
