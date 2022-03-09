<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Prevents mass assignment for following keys
    // We have to be careful here not to forget a key
    // Guarded with an empty array disables mass assignment completely
    protected $guarded = ['id'];

    // Allows mass assignment for following keys
    // This is more explicit, and prevents from missing something
    protected $fillable = ['title', 'excerpt', 'body'];
}
