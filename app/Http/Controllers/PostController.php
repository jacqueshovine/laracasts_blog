<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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


        return view('posts.index', [
            'posts' => Post::latest()->filter(
                request(['search', 'category', 'author'])
            )->paginate(6)->withQueryString(), // Will use the search function if a search term is filled (using the scopeFilter method from Model), return all posts if not.
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }
}
