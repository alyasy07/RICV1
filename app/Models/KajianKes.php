<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KajianKes extends Model
{
    use HasFactory;

    protected $table = 'kajian_kes';

    protected $fillable = [
        'nama_ketua_penidik',
        'ahli',
        'tajuk_kajian_kes',
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
