<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    /**
     * Menandakan nama tabel yang
     * digunakan oleh model ini
     * 
     * @var string
     */
    protected $table = 'mahasiswa';
    
    /**
     * Menandakan kolom apa yang
     * dijadikan primary key
     * 
     * @var string 
     */
    protected $primaryKey = 'nim';

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
        'nim',
        'nama_mahasiswa',
        'kd_kelas',
        'id_user',
        'foto_mahasiswa',
        'device_imei'
    ];

    /**
     * Menandai bahwa tabel mahasiswa memiliki
     * foreign key relation one to one 
     * terhadap tabel user
     */
    public function user()
    {
        return $this->belongsTo('App\User','id_user');
    }

    /**
     * Menandai bahwa tabel mahasiswa memiliki
     * foreign key relation one to one 
     * terhadap tabel kelas
     */
    public function kelas()
    {
        return $this->belongsTo('App\Kelas', 'kd_kelas');
    }

    /**
     * Menandai bahwa tabel mahasiswa memiliki
     * relation one to many 
     * terhadap tabel suratizin
     */
    public function suratIzin()
    {
        return $this->hasMany('App\SuratIzin','kd_surat');
    }
}
