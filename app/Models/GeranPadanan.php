<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeranPadanan extends Model
{
    use HasFactory;

    protected $table = 'geran_padanan';

    protected $fillable = [
        'nama_pemohon',
        'institusi_terlibat',
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
