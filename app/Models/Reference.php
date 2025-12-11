<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'file_path',
        'url',
        'reference_type',
        'thumbnail_path',
        'file_type',
        'file_size',
        'uploaded_by',
    ];

    /**
     * Uploader relationship
     */
    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by', 'userID');
    }

    /**
     * Get human-readable file size
     */
    public function getFileSizeHumanAttribute()
    {
        $bytes = $this->file_size;
        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        } else {
            return $bytes . ' bytes';
        }
    }

    /**
     * Get thumbnail URL
     */
    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail_path) {
            return asset('storage/' . $this->thumbnail_path);
        }
        return asset('images/pdf-placeholder.png'); // fallback
    }
}
