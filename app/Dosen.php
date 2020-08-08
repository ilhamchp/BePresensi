<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    /**
     * Menandakan nama tabel yang
     * digunakan oleh model ini
     * 
     * @var string
     */
    protected $table = 'dosen';
    
    /**
     * Menandakan kolom apa yang
     * dijadikan primary key
     * 
     * @var string 
     */
    protected $primaryKey = 'kd_dosen';

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
        'kd_dosen',
        'nama_dosen',
        'id_user'
    ];

    /**
     * Get the user that is dosen.
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'id');
    }

    /**
     * Menandai bahwa tabel dosen memiliki
     * relation one to one 
     * terhadap tabel kelas
     * relation berupa : Wali Dosen dan Kelas
     */
    public function kelas()
    {
        return $this->hasOne('App\Kelas', 'kd_wali_dosen');
    }
}
