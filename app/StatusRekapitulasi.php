<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusRekapitulasi extends Model
{
    /**
     * Menandakan nama tabel yang
     * digunakan oleh model ini
     * 
     * @var string
     */
    protected $table = 'status_rekapitulasi';
    
    /**
     * Menandakan kolom apa yang
     * dijadikan primary key
     * 
     * @var string 
     */
    protected $primaryKey = 'kd_status_rekapitulasi';

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
        'kd_status_rekapitulasi',
        'keterangan_rekapitulasi'
    ];


    /**
     * Menandai bahwa tabel status rekapitulasi memiliki
     * relation one to many 
     * terhadap tabel rekapitulasi
     */
    public function rekapitulasi()
    {
        return $this->hasMany('App\Rekapitulasi','kd_status_rekapitulasi');
    }
}
