<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    /**
     * Menandakan nama tabel yang
     * digunakan oleh model ini
     * 
     * @var string
     */
    protected $table = 'jadwal';
    
    /**
     * Menandakan kolom apa yang
     * dijadikan primary key
     * 
     * @var string 
     */
    protected $primaryKey = 'kd_jadwal';

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
        'kd_jadwal',
        'kd_kelas',
        'kd_hari',
        'kd_sesi_mulai',
        'kd_sesi_berakhir',
        'kd_ruang',
        'kd_matakuliah',
        'kd_dosen_pengajar',
        'jenis_perkuliahan',
        'sesi_presensi_dibuka',
        'toleransi_keterlambatan'
    ];

    /**
     * Menandai bahwa tabel jadwal memiliki
     * foreign key relation one to one 
     * terhadap tabel kelas
     */
    public function kelas()
    {
        return $this->belongsTo('App\Kelas','kd_kelas');
    }

    /**
     * Menandai bahwa tabel jadwal memiliki
     * foreign key relation one to one 
     * terhadap tabel hari
     */
    public function hari()
    {
        return $this->belongsTo('App\Hari','kd_hari');
    }

    /**
     * Menandai bahwa tabel jadwal memiliki
     * foreign key relation one to many 
     * terhadap tabel sesi
     */ 
    public function sesiMulai()
    {
        return $this->belongsTo('App\Sesi','kd_sesi_mulai');
    }

    public function sesiBerakhir()
    {
        return $this->belongsTo('App\Sesi','kd_sesi_berakhir');
    }

    /**
     * Menandai bahwa tabel jadwal memiliki
     * foreign key relation one to one 
     * terhadap tabel ruang
     */
    public function ruang()
    {
        return $this->belongsTo('App\Ruang','kd_ruang');
    }

    /**
     * Menandai bahwa tabel jadwal memiliki
     * foreign key relation one to one 
     * terhadap tabel matakuliah
     */
    public function matakuliah()
    {
        return $this->belongsTo('App\Matakuliah','kd_matakuliah');
    }

    /**
     * Menandai bahwa tabel jadwal memiliki
     * foreign key relation one to one 
     * terhadap tabel dosen
     */
    public function dosen()
    {
        return $this->belongsTo('App\Dosen','kd_dosen_pengajar');
    }

    /**
     * Menandai bahwa tabel jadwal memiliki
     * relation one to many
     * terhadap tabel berita acara
     */
    public function beritaAcara()
    {
        return $this->hasMany('App\BeritaAcara','kd_berita_acara');
    }
}
