<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sesi extends Model
{
    /**
     * Menandakan nama tabel yang
     * digunakan oleh model ini
     * 
     * @var string
     */
    protected $table = 'sesi';
    
    /**
     * Menandakan kolom apa yang
     * dijadikan primary key
     * 
     * @var string 
     */
    protected $primaryKey = 'kd_sesi';

    /**
     * Menandakan apakah kolom
     * primary key bersifat incremental
     * atau tidak
     * 
     * @var boolean
     */
    public $incrementing = false;

    /**
     * Menandakan apakah tabel
     * memiliki kolom timestamps
     * 
     * @var boolean
     */
    public $timestamps = false;

    /**
     * Menandakan kolom apa saja
     * yang dapat diisi pada database
     * 
     * @var array
     */
    protected $fillable = [
        'kd_sesi',
        'jam_mulai',
        'jam_berakhir'
    ];

    /**
     * Menandai bahwa tabel sesi memiliki
     * relation one to many 
     * terhadap tabel jadwal
     */
    public function jadwal()
    {
        return $this->hasMany('App\Jadwal','kd_jadwal');
    }
}
