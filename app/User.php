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
     * terhadap tabel staff dosen
     */
    public function dosen()
    {
        return $this->hasOne('App\Dosen', 'id_user');
    }

    public $timestamps = false;

}
