<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlobalAntarabangsa extends Model
{
    use HasFactory;
    
    protected $table = 'global_antarabangsa';
    
    protected $fillable = [
        'pelaporan_id',
        'kategori_kerjasama',
        'skop_kerjasama',
        'negara',
        'institusi',
        'impak_kerjasama'
    ];
    
    /**
     * Get the pelaporan record that owns this antarabangsa.
     */
    public function pelaporan()
    {
        return $this->belongsTo(Pelaporan::class);
    }
}