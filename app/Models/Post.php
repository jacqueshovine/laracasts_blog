<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post 
{

    public $title;

    public $excerpt;

    public $date;

    public $body;

    public $slug;

    public function __construct($title, $excerpt, $date, $body, $slug)
    {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
        $this->slug = $slug;
    }

    public static function all()
    {
        return collect(File::files(resource_path("posts")))
            ->map(function ($file) {
                return YamlFrontMatter::parseFile($file);
            })
            ->map(function ($document) {
                
                return new Post(
                    $document->title,
                    $document->excerpt,
                    $document->date,
                    $document->body(),
                    $document->slug,
                );
            });
    }

    public static function find($slug) {

        return static::all()->firstWhere('slug', $slug);

        // if (! file_exists($path = resource_path("posts/{$slug}.html"))) {
        //     // dump and die
        //     // dd($path);

        //     // Throw 404
        //     // abort(404);

        //     // Sends back to home page
        //     // return redirect('/');

        //     throw new ModelNotFoundException();

        // }

        // Return the post + cache
        // return cache()->remember("posts.{$slug}", now()->addMinutes(60), function () use($path){
        //     return file_get_contents($path);
        // });
    }

}