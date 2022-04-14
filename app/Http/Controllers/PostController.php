<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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

    public function store()
    {

        // dd(request()->file('thumbnail'));

        $attributes = request()->validate([
            'title' => 'required|min:3|max:50',
            'thumbnail' => 'required|image',
            'thumbnail_alt' => 'min:3|max:255',
            'slug' => ['required', Rule::unique('posts', 'slug')],
            'excerpt' => 'required|min:3|max:255',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')],
        ]);

        $attributes['user_id'] = auth()->id();
        $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails'); // Contains the path where the file is stored

        Post::create($attributes);

        return redirect('/');
    }
}
