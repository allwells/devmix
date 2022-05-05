<?php

namespace App\Models;

use App\Models\Post;
use App\Models\User;
use App\Models\CommentLikes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'comments'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(CommentLikes::class);
    }

    public function likedBy(User $user)
    {
       return $this->likes->contains('user_id', $user->id);
    }
}