<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rekapitulasi extends Model
{
    /**
     * Menandakan nama tabel yang
     * digunakan oleh model ini
     * 
     * @var string
     */
    protected $table = 'rekapitulasi';
    
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
        'sakit',
        'izin',
        'alfa',
        'kd_status_rekapitulasi'
    ];

    /**
     * Menandai bahwa tabel rekapitulasi memiliki
     * foreign key relation one to one 
     * terhadap tabel mahasiswa
     */
    public function mahasiswa()
    {
        return $this->belongsTo('App\Mahasiswa', 'nim');
    }

    /**
     * Menandai bahwa tabel rekapitulasi memiliki
     * foreign key relation one to one 
     * terhadap tabel mahasiswa
     */
    public function statusRekapitulasi()
    {
        return $this->belongsTo('App\StatusRekapitulasi', 'kd_status_rekapitulasi');
    }
}
