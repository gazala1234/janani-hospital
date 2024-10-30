<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventParticipants extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'event_id', 
        'user_id'
    ];

    /**
     * Define a relationship with the Event model.
     * Each participant belongs to one event.
     */
    public function event()
    {
        return $this->belongsTo(Events::class);
    }

    /**
     * Define a relationship with the User model.
     * Each participant is associated with one user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}