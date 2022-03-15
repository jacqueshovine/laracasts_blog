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

    // This method sets the default key for Route Model binding
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function category()
    {
        // hasOne, hasMany, belongsTo, belongsToMany
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        // hasOne, hasMany, belongsTo, belongsToMany
        return $this->belongsTo(User::class, 'user_id'); 
        // We specify the foreign key as a parameter, because the function has a different name. 
        // This wouldn't be needed if the function was user() instead of author()
    }
}
