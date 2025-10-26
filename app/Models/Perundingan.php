<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perundingan extends Model
{
    use HasFactory;

    protected $table = 'perundingan';

    protected $fillable = [
        'nama_ketua_penyelidik',
        'penyelidik_bersama',
        'nama_pelanggan',
        'bidang_projek',
        'lokasi_projek',
        'tajuk_penyelidikan',
        'jumlah_dana_dipohon',
        'tempoh_penyelidikan',
        'status_permohonan',
        'user_id'
    ];

    protected $casts = [
        'jumlah_dana_dipohon' => 'decimal:2',
    ];
}
