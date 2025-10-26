<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengarah extends Model
{
    use HasFactory;

    protected $table = 'pengarah';

    protected $fillable = [
        'user_id',
        'tajuk',
        'perkara',
        'tarikh',
        'status',
    ];

    protected $casts = [
        'tarikh' => 'date',
    ];

    /**
     * Get the user that owns the pengarah record.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
