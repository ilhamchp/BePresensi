<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    /**
     * Menandakan apakah tabel
     * memiliki kolom timestamps
     * 
     * @var boolean
     */
    public $timestamps = false;

    /**
     * Menandai bahwa tabel user memiliki
     * relation one to one 
     * terhadap tabel staff tata usaha
     */
    public function staffTataUsaha()
    {
        return $this->hasOne('App\StaffTataUsaha', 'id_user');
    }

    /**
     * Menandai bahwa tabel user memiliki
     * relation one to one 
     * terhadap tabel dosen
     */
    public function dosen()
    {
        return $this->hasOne('App\Dosen', 'id_user');
    }

    /**
     * Menandai bahwa tabel user memiliki
     * relation one to one 
     * terhadap tabel dosen
     */
    public function mahasiswa()
    {
        return $this->hasOne('App\Mahasiswa', 'id_user');
    }
}
