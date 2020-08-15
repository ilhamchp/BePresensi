<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    /**
     * Menandakan nama tabel yang
     * digunakan oleh model ini
     * 
     * @var string
     */
    protected $table = 'kelas';
    
    /**
     * Menandakan kolom apa yang
     * dijadikan primary key
     * 
     * @var string 
     */
    protected $primaryKey = 'kd_kelas';

    protected $keyType = 'string';

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
        'kd_kelas',
        'tingkat_kelas',
        'prodi',
        'angkatan',
        'kd_wali_dosen'
    ];

    /**
     * Menandai bahwa tabel kelas memiliki
     * foreign key relation one to one 
     * terhadap tabel dosen
     */
    public function waliDosen()
    {
        return $this->belongsTo('App\Dosen', 'kd_wali_dosen');
    }

    /**
     * Menandai bahwa tabel kelas memiliki
     * relation one to many 
     * terhadap tabel mahasiswa
     */
    public function mahasiswa()
    {
        return $this->hasMany('App\Mahasiswa', 'nim');
    }

    /**
     * Menandai bahwa tabel kelas memiliki
     * relation one to many 
     * terhadap tabel jadwal
     */
    public function jadwal()
    {
        return $this->hasMany('App\Jadwal','kd_jadwal');
    }
}
