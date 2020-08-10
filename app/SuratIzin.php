<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuratIzin extends Model
{
    /**
     * Menandakan nama tabel yang
     * digunakan oleh model ini
     * 
     * @var string
     */
    protected $table = 'surat_izin';
    
    /**
     * Menandakan kolom apa yang
     * dijadikan primary key
     * 
     * @var string 
     */
    protected $primaryKey = 'kd_surat_izin';

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
        'kd_surat_izin',
        'kd_jenis_izin',
        'nim',
        'tgl_mulai',
        'tgl_selesai',
        'jam_mulai',
        'jam_selesai',
        'kd_status_surat',
        'catatan_surat',
        'catatan_wali_dosen',
        'foto_surat'
    ];

    /**
     * Menandai bahwa tabel surat izin memiliki
     * foreign key relation many to one 
     * terhadap tabel mahasiswa 
     */
    public function mahasiswa()
    {
        return $this->belongsTo('App\Mahasiswa','nim');
    }

    /**
     * Menandai bahwa tabel surat izin memiliki
     * foreign key relation many to one 
     * terhadap tabel mahasiswa 
     */
    public function jenisIzin()
    {
        return $this->belongsTo('App\StatusPresensi','kd_jenis_izin');
    }

    /**
     * Menandai bahwa tabel surat izin memiliki
     * foreign key relation many to one 
     * terhadap tabel status surat 
     */
    public function statusSurat()
    {
        return $this->belongsTo('App\StatusSurat','kd_status_surat');
    }
}
