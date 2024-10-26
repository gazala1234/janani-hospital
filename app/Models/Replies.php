<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Replies extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'replies';

    protected $fillable = [
        'user_id',
        'comment_id',
        'content',
        'path',
        'replies_count',
        'likes_count',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comment()
    {
        return $this->belongsTo(Comments::class);
    }

    public function replies()
    {
        return $this->hasMany(self::class, 'comment_id', 'id');
    }
}
