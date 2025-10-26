<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoaMou extends Model
{
    use HasFactory;

    protected $table = 'moa_mou';

    protected $fillable = [
        'jenis_perundingan',
        'agensi_terlibat',
        'tajuk_penyelidikan',
        'status_permohonan',
        'user_id'
    ];
}
