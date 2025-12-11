<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Canvas extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'research_working_title',
        'thesis_title',
        'abstract',
        'results_summary',
    ];

    protected $casts = [
        'abstract' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(NewUser::class, 'user_id');
    }

    public function backgroundItems(): HasMany
    {
        return $this->hasMany(CanvasBackgroundItem::class)->orderBy('order');
    }

    public function flows(): HasMany
    {
        return $this->hasMany(CanvasFlow::class)->orderBy('order');
    }
}