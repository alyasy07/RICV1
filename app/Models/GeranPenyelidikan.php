<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeranPenyelidikan extends Model
{
    protected $table = 'geran_penyelidikan';
    
    protected $fillable = [
        'nama_ketua_penyelidik',
        'penyelidik_bersama',
        'nama_geran',
        'pemberi_dana',
        'tarikh_tutup_permohonan',
        'tajuk_penyelidikan',
        'jumlah_dana',
        'status_permohonan',
        'user_id'
    ];

    protected $casts = [
        'tarikh_tutup_permohonan' => 'date'
    ];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'userID');
    }
}
