<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserDetails extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'user_details';

    protected $fillable = [
        'fname',
        'lname',
        'city',
        'email',
        'country',
        'dob',
        'mobile',
        'blood_group',
        'address',
        'img_path',
    ];

    /**
     * Get the user associated with the user detail.
     */
    public function users()
    {
        return $this->belongsTo(User::class, 'mobile', 'mobile');
    }
}
