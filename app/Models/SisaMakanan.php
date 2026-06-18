<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SisaMakanan extends Model
{
    protected $fillable = [
        'tanggal',
        'nama',
        'petugas',
        'ruangan',
        'foto',
        'nasi',
        'hewani',
        'nabati',
        'sayur',
        'buah',
        'rata_rata'
    ];
}
