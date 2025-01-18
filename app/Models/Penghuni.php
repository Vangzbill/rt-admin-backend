<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penghuni extends Model
{
    protected $table = 'penghuni';

    protected $fillable = [
        'nama_lengkap',
        'foto_ktp',
        'status_penghuni',
        'nomor_telepon',
        'status_pernikahan',
    ];

    public function historiPenghuni(){
        return $this->hasMany(HistoriPenghuni::class, 'penghuni_id');
    }
}
