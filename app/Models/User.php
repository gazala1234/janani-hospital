<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'users';
    
    protected $fillable = [
        'mobile',
        'otp',
        'otp_expires_at',
        'role',
    ];

    /**
     * Get the user detail associated with the user.
     */
    public function userDetails()
    {
        return $this->hasOne(UserDetails::class, 'user_id', 'id');
    }
    
}