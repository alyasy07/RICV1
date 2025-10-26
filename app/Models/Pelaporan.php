<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelaporan extends Model
{
    use HasFactory;
    
    protected $table = 'pelaporan';
    
    protected $fillable = [
        'user_id',
        'title',
        'pemberi_dana',
        'tarikh_tutup',
        'jumlah_dana',
        'status',
        'jenis'
    ];
    
    /**
     * Get the user that owns the pelaporan.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'userID');
    }
    
    /**
     * Get the specific details based on jenis pelaporan.
     */
    public function details()
    {
        switch ($this->jenis) {
            case 'penerbitan_penulisan':
                return $this->hasOne(PenerbitanPenulisan::class, 'pelaporan_id');
            case 'global_antarabangsa':
                return $this->hasOne(GlobalAntarabangsa::class, 'pelaporan_id');
            case 'inovasi_pengkomersilan':
                return $this->hasOne(InovasiPengkomersilan::class, 'pelaporan_id');
            case 'penyelidikan_keusahawanan':
                return $this->hasOne(PenyelidikanKeusahawanan::class, 'pelaporan_id');
            default:
                return null;
        }
    }
    
    /**
     * Get the penyelidikan_keusahawanan record associated with this pelaporan.
     */
    public function penyelidikanKeusahawanan()
    {
        return $this->hasOne(PenyelidikanKeusahawanan::class, 'pelaporan_id');
    }
    
    /**
     * Get the penerbitan_penulisan record associated with this pelaporan.
     */
    public function penerbitanPenulisan()
    {
        return $this->hasOne(PenerbitanPenulisan::class, 'pelaporan_id');
    }
    
    /**
     * Get the global_antarabangsa record associated with this pelaporan.
     */
    public function globalAntarabangsa()
    {
        return $this->hasOne(GlobalAntarabangsa::class, 'pelaporan_id');
    }
    
    /**
     * Get the inovasi_pengkomersilan record associated with this pelaporan.
     */
    public function inovasiPengkomersilan()
    {
        return $this->hasOne(InovasiPengkomersilan::class, 'pelaporan_id');
    }
    
    /**
     * Scope query to only include pelaporan of a given type.
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('jenis', $type);
    }
}