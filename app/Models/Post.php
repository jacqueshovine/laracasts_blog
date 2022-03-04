<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class Post 
{

    public static function find($slug) {

        if (! file_exists($path = resource_path("posts/{$slug}.html"))) {
            // dump and die
            // dd($path);

            // Throw 404
            // abort(404);

            // Sends back to home page
            // return redirect('/');

            throw new ModelNotFoundException();

        }

        // Return the post
        return cache()->remember("posts.{$slug}", now()->addMinutes(60), function () use($path){
            return file_get_contents($path);
        });
    }

}