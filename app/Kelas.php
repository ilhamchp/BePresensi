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
     * Get the dosen that is walidosen.
     */
    public function waliDosen()
    {
        return $this->belongsTo('App\Dosen');
    }
}
