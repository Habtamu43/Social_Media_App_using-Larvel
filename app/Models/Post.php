<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Define the relationship to the Comment model
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Define the relationship with the Like model
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // Optional: Method to check if the post is liked by a specific user
    public function isLikedByUser($userId)
    {
        return $this->likes()->where('user_id', $userId)->exists();
    }
}
