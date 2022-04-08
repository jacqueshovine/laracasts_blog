<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function post()
    {
        // Here, Laravel will assume that the foreign key is post_id (by default)
        return $this->belongsTo(Post::class);
    }

    public function author()
    {
        // The function does not have the same name as the class, hence why we need to specify the columns
        return $this->belongsTo(User::class, 'user_id');
    }
}
