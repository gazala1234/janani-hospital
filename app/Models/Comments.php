<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comments extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'comments';

    protected $fillable = [
        'user_id',
        'post_id',
        'content',
        'path',
        'comments_count',
        'likes_count',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    

    public function post()
    {
        return $this->belongsTo(Posts::class);
    }

    public function replies()
    {
        return $this->hasMany(Replies::class);
    }

    
}
