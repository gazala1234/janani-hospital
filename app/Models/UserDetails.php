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
        'user_id',
        'city',
        'email',
        'country',
        'dob',
        'blood_group',
        'address',
        'img_path',
    ];

    /**
     * Get the user associated with the user detail.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}