<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ruang extends Model
{
    /**
     * Menandakan nama tabel yang
     * digunakan oleh model ini
     * 
     * @var string
     */
    protected $table = 'ruang';
    
    /**
     * Menandakan kolom apa yang
     * dijadikan primary key
     * 
     * @var string 
     */
    protected $primaryKey = 'kd_ruang';

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
        'kd_ruang',
        'nama_ruang',
        'kd_beacon'
    ];

    /**
     * Menandai bahwa tabel ruang memiliki
     * foreign key relation one to one 
     * terhadap tabel beacon
     */
    public function beacon()
    {
        return $this->belongsTo('App\Beacon', 'kd_beacon');
    }
}
