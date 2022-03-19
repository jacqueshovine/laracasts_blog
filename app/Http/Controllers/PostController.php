<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
    
        // This will show the Sql query in app/storage/logs/laravel.log file
        // Alternatively we can use clockwork browser extension
        // 
        // DB::listen(function ($query) {
        //     logger($query->sql, $query->bindings);
        // });
    
        // Return all posts without collect method
    
        // $files = File::files(resource_path("posts"));
    
        // $posts = array_map(function ($file) {
    
        //     $document = YamlFrontMatter::parseFile($file);
    
        //     return new Post(
        //         $document->title,
        //         $document->excerpt,
        //         $document->date,
        //         $document->body,
        //         $document->slug,
        //     );
        // }, $files);
    
        return view('posts', [
            'posts' => Post::latest()->filter(request(['search']))->get(), // Will use the search function is a search term is filled (using the scopeFilter method from Model), return all posts if not.
            'categories' => Category::all(),
        ]);
    }

    public function show(Post $post)
    {
        return view('post', [
            'post' => $post
        ]);
    }
}
