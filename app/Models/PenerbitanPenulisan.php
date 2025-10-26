<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenerbitanPenulisan extends Model
{
    use HasFactory;
    
    protected $table = 'penerbitan_penulisan';
    
    protected $fillable = [
        'pelaporan_id',
        'jenis_penerbitan',
        'penerbit',
        'isbn',
        'tajuk_karya',
        'sinopsis',
        'tarikh_terbit'
    ];
    
    /**
     * Get the pelaporan record that owns this penerbitan.
     */
    public function pelaporan()
    {
        return $this->belongsTo(Pelaporan::class);
    }
}