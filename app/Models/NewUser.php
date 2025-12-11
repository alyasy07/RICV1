<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class NewUser extends Authenticatable
{
    use Notifiable;

    protected $table = 'new_users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
    
    /**
     * Canvases relationship
     */
    public function canvases()
    {
        return $this->hasMany(Canvas::class, 'user_id');
    }
}
