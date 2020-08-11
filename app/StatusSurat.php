<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusSurat extends Model
{
    /**
     * Menandakan nama tabel yang
     * digunakan oleh model ini
     * 
     * @var string
     */
    protected $table = 'status_surat';
    
    /**
     * Menandakan kolom apa yang
     * dijadikan primary key
     * 
     * @var string 
     */
    protected $primaryKey = 'kd_status_surat';

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
        'kd_status_surat',
        'keterangan_surat'
    ];


    /**
     * Menandai bahwa tabel status surat memiliki
     * relation one to many 
     * terhadap tabel surat izin 
     */
    public function suratIzin()
    {
        return $this->hasMany('App\SuratIzin','kd_surat_izin');
    }

}
