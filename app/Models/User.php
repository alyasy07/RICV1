<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPasswordTrait;
use Illuminate\Notifications\Notifiable;

class User extends Model implements Authenticatable, CanResetPassword
{
    use \Illuminate\Auth\Authenticatable, CanResetPasswordTrait, Notifiable;

    protected $table = 'user';
    protected $primaryKey = 'userID';
    public $incrementing = false; // Since userID is a string, not auto-incrementing
    protected $keyType = 'string'; // Specify that the primary key is a string
    
    protected $fillable = [
        'userID',
        'username',
        'icNumber',
        'email',
        'role',
        'password',
        'userStatus',
        'profilePicture',
        'remember_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // The Authenticatable trait handles getAuthIdentifier() and getAuthPassword()
    // No need to override since we're setting $primaryKey = 'userID' above
    
    public function getEmailForPasswordReset()
    {
        return $this->email;
    }

    public function isActive()
    {
        return $this->userStatus === 'Aktif';
    }

    public function isAdmin()
    {
        return strtolower($this->role) === 'admin';
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * Get the route key for the model (for route model binding)
     */
    public function getRouteKeyName()
    {
        return 'userID';
    }

    /**
     * Get the full role name for display
     */
    public function getRoleDisplayNameAttribute()
    {
        $roleNames = [
            'Admin' => 'Admin',
        ];

        return $roleNames[$this->role] ?? $this->role;
    }
    
}