<?php

use Illuminate\Database\Seeder;
use App\User;
use App\StaffTataUsaha;


class StaffTataUsahaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->storeStaff([
            'kd_staff' => 'LIA1309',
            'nama_staff' => 'Lia Rahmawati',
            'password' => 'password',
            'foto_staff' => 'photo.jpg'
        ]);
        
        $this->storeStaff([
            'kd_staff' => 'MARA3201',
            'nama_staff' => 'Mara Sonang',
            'password' => 'password',
            'foto_staff' => 'photo.jpg'
        ]);
    }

    public function storeStaff($data){
        $user = new User;
        $user->email = $data['kd_staff'] .'@yopmail.com';
        $user->password = bcrypt($data['password']);
        $user->save();

        $staff = new StaffTataUsaha;
        $staff->kd_staff = $data['kd_staff'];
        $staff->nama_staff = $data['nama_staff'];
        $staff->foto_staff = $data['foto_staff'];
        $staff->user()->associate($user);
        $staff->save();
    }
    
}
