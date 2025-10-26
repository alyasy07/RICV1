<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InovasiPengkomersilan extends Model
{
    use HasFactory;
    
    protected $table = 'inovasi_pengkomersilan';
    
    protected $fillable = [
        'pelaporan_id',
        'jenis_inovasi',
        'tahap_pengkomersilan',
        'deskripsi_inovasi',
        'hak_cipta',
        'status_paten',
        'potensi_pasaran'
    ];
    
    /**
     * Get the pelaporan record that owns this inovasi.
     */
    public function pelaporan()
    {
        return $this->belongsTo(Pelaporan::class);
    }
}