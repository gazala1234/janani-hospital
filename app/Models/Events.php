<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Events extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 
        'title', 
        'description', 
        'mode', 
        'address', 
        'date', 
        'start_time', 
        'end_time', 
        'img_path', 
        'status'
    ];

    /**
     * Define a relationship with the User model.
     * Each event belongs to one user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Define a relationship with the EventParticipant model.
     * An event can have many participants.
     */
    public function participants()
    {
        return $this->hasMany(EventParticipants::class);
    }
}