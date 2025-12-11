<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CanvasFlow extends Model
{
    use HasFactory;

    protected $fillable = [
        'canvas_id',
        'problem',
        'objective',
        'methodology',
        'discussion',
        'conclusion',
        'order',
    ];

    public function canvas(): BelongsTo
    {
        return $this->belongsTo(Canvas::class);
    }
}