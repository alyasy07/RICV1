<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenyelidikanKeusahawanan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'penyelidikan_keusahawanan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pelaporan_id',
        'bidang_penyelidikan',
        'hasil_penyelidikan',
        'ketua_penyelidik',
        'ahli_penyelidik',
        'tempoh_penyelidikan',
        'objektif_kajian'
    ];

    /**
     * Get the pelaporan record that owns this penyelidikan.
     */
    public function pelaporan()
    {
        return $this->belongsTo(Pelaporan::class);
    }
}