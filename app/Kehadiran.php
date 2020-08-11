<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    /**
     * Menandakan nama tabel yang
     * digunakan oleh model ini
     * 
     * @var string
     */
    protected $table = 'kehadiran';

    /**
     * Menandakan apakah kolom
     * primary key bersifat incremental
     * atau tidak
     * 
     * @var boolean
     */
    public $incrementing = true;

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
        'kd_jadwal',
        'kd_sesi',
        'kd_status_presensi',
        'kd_surat_izin',
        'tgl_presensi',
        'jam_presensi'
    ];

    /**
     * Menandai bahwa tabel kehadiran memiliki
     * foreign key relation one to one 
     * terhadap tabel mahasiswa
     */
    public function mahasiswa()
    {
        return $this->belongsTo('App\Mahasiswa','nim');
    }

    /**
     * Menandai bahwa tabel kehadiran memiliki
     * foreign key relation one to one 
     * terhadap tabel jadwal
     */
    public function jadwal()
    {
        return $this->belongsTo('App\Jadwal','kd_jadwal');
    }

    /**
     * Menandai bahwa tabel kehadiran memiliki
     * foreign key relation one to one 
     * terhadap tabel sesi
     */
    public function sesi()
    {
        return $this->belongsTo('App\Sesi','kd_sesi');
    }

    /**
     * Menandai bahwa tabel kehadiran memiliki
     * foreign key relation one to one 
     * terhadap tabel status presensi
     */
    public function statusPresensi()
    {
        return $this->belongsTo('App\StatusPresensi','kd_status_presensi');
    }

    /**
     * Menandai bahwa tabel kehadiran memiliki
     * foreign key relation one to one 
     * terhadap tabel surat izin
     */
    public function suratIzin()
    {
        return $this->belongsTo('App\SuratIzin','kd_surat_izin');
    }
}
