<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoriPenghuni extends Model
{
    protected $table = 'histori_penghuni';

    protected $fillable = [
        'penghuni_id',
        'rumah_id',
        'tanggal_masuk',
        'tanggal_keluar',
    ];

    public function penghuni(){
        return $this->belongsTo(Penghuni::class, 'penghuni_id');
    }

    public function rumah(){
        return $this->belongsTo(Rumah::class, 'rumah_id');
    }
}
