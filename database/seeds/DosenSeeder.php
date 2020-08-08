<?php

use Illuminate\Database\Seeder;
use App\Dosen;
use App\User;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->storeDosen( [
        'kd_dosen'=>'KO001N',
        'nama_dosen'=>'Ade Chandra Nugraha'
        ] );
        
        $this->storeDosen( [
        'kd_dosen'=>'KO002N',
        'nama_dosen'=>'Ani Rahmani'
        ] );
        
        $this->storeDosen( [
        'kd_dosen'=>'KO003N',
        'nama_dosen'=>'Bambang Wisnuadhi'
        ] );
        
        $this->storeDosen( [
        'kd_dosen'=>'KO004N',
        'nama_dosen'=>'Dewa Gede Parta'
        ] );
        
        $this->storeDosen( [
        'kd_dosen'=>'KO005N',
        'nama_dosen'=>'Didik Suwito Pribadi'
        ] );
        
        $this->storeDosen( [
        'kd_dosen'=>'KO006N',
        'nama_dosen'=>'Irawan Thamrin'
        ] );
        
        $this->storeDosen( [
        'kd_dosen'=>'KO007N',
        'nama_dosen'=>'Joe Lian Min'
        ] );
        
        $this->storeDosen( [
        'kd_dosen'=>'KO008N',
        'nama_dosen'=>'Nurjannah Syakrani'
        ] );
        
        $this->storeDosen( [
        'kd_dosen'=>'KO009N',
        'nama_dosen'=>'Santi Sundari'
        ] );
        
        $this->storeDosen( [
        'kd_dosen'=>'KO011N',
        'nama_dosen'=>'Tati Susilawati'
        ] );
        
        $this->storeDosen( [
        'kd_dosen'=>'KO012N',
        'nama_dosen'=>'Urip Teguh Setijohatmo'
        ] );
        
        $this->storeDosen( [
        'kd_dosen'=>'KO013N',
        'nama_dosen'=>'Yudi Widhiyasana'
        ] );
        
        $this->storeDosen( [
        'kd_dosen'=>'KO014N',
        'nama_dosen'=>'Amir Hamzah'
        ] );
        
        $this->storeDosen( [
        'kd_dosen'=>'KO016N',
        'nama_dosen'=>'Eddy Bambang Soewono'
        ] );
        
        $this->storeDosen( [
        'kd_dosen'=>'KO017N',
        'nama_dosen'=>'Ferry Feirizal'
        ] );
        
        $this->storeDosen( [
        'kd_dosen'=>'KO018N',
        'nama_dosen'=>'Jonner Hutahaean'
        ] );
        
        $this->storeDosen( [
        'kd_dosen'=>'KO019N',
        'nama_dosen'=>'Transmissia Semiawan'
        ] );
        
        $this->storeDosen( [
        'kd_dosen'=>'KO021N',
        'nama_dosen'=>'Setiadi Rachmat'
        ] );
        
        $this->storeDosen( [
        'kd_dosen'=>'KO022N',
        'nama_dosen'=>'Suprihanto'
        ] );
        
        $this->storeDosen( [
        'kd_dosen'=>'KO023N',
        'nama_dosen'=>'Iwan Awaludin'
        ] );
        
        $this->storeDosen( [
        'kd_dosen'=>'KO026N',
        'nama_dosen'=>'Titis Sutisna'
        ] );
        
        $this->storeDosen( [
        'kd_dosen'=>'KO045N',
        'nama_dosen'=>'Irwan Setiawan'
        ] );
        
        $this->storeDosen( [
        'kd_dosen'=>'KO048N',
        'nama_dosen'=>'Priyanto Hidayatullah'
        ] );
        
        $this->storeDosen( [
        'kd_dosen'=>'KO052N',
        'nama_dosen'=>'Yadhi Aditya Permana'
        ] );
        
        $this->storeDosen( [
        'kd_dosen'=>'KO056N',
        'nama_dosen'=>'Ida Suhartini'
        ] );
        
        $this->storeDosen( [
        'kd_dosen'=>'KO057N',
        'nama_dosen'=>'Fitri Diani'
        ] );
        
        $this->storeDosen( [
        'kd_dosen'=>'KO059N',
        'nama_dosen'=>'Ghifari Munawar'
        ] );
        
        $this->storeDosen( [
        'kd_dosen'=>'KO060N',
        'nama_dosen'=>'Ade Hodijah'
        ] );
        
        $this->storeDosen( [
        'kd_dosen'=>'KO061N',
        'nama_dosen'=>'Zulkifli Arsyad'
        ] );
        
        $this->storeDosen( [
        'kd_dosen'=>'KO062K',
        'nama_dosen'=>'Rahil Jumiyani'
        ] );
    }
    public function storeDosen($data){
        $user = new User;
        $user->email = $data['kd_dosen'] .'@yopmail.com';
        $user->password = md5('password');
        $user->save();

        $dosen = new Dosen;
        $dosen->kd_dosen = $data['kd_dosen'];
        $dosen->nama_dosen = $data['nama_dosen'];
        $dosen->foto_dosen = 'photo.jpg';
        $dosen->user()->associate($user);
        $dosen->save();
    }
}
