<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rumah extends Model
{
    protected $table = 'rumah';

    protected $fillable = [
        'nomor_rumah',
        'status_dihuni',
    ];

    public function historiPenghuni(){
        return $this->hasMany(HistoriPenghuni::class, 'rumah_id');
    }
}
