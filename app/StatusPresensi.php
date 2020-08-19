<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusPresensi extends Model
{
    /**
     * Menandakan nama tabel yang
     * digunakan oleh model ini
     * 
     * @var string
     */
    protected $table = 'status_presensi';
    
    /**
     * Menandakan kolom apa yang
     * dijadikan primary key
     * 
     * @var string 
     */
    protected $primaryKey = 'kd_status_presensi';

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
        'kd_status_presensi',
        'keterangan_presensi'
    ];


    /**
     * Menandai bahwa tabel status presensi memiliki
     * relation one to many 
     * terhadap tabel surat izin
     */
    public function suratIzin()
    {
        return $this->hasMany('App\SuratIzin','kd_jenis_izin');
    }

    /**
     * Menandai bahwa tabel status presensi memiliki
     * relation one to many 
     * terhadap tabel kehadiran
     */
    public function kehadiran()
    {
        return $this->hasMany('App\Kehadiran','kd_status_presensi');
    }
}
