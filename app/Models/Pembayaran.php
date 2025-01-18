<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';

    protected $fillable = [
        'penghuni_id',
        'rumah_id',
        'jenis_iuran',
        'jumlah_iuran',
        'periode',
        'status_pembayaran',
    ];

    public function penghuni(){
        return $this->belongsTo(Penghuni::class, 'penghuni_id');
    }

    public function rumah(){
        return $this->belongsTo(Rumah::class, 'rumah_id');
    }
}
