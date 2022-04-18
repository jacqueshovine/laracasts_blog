<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminPostController extends Controller
{
    public function index()
    {
        return view('admin.posts.index', [
            'posts' => Post::paginate(50)
        ]);
    }

    public function create()
    {
        return view('admin.posts.create');
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

    public function edit(Post $post)
    {
        return view('admin.posts.edit', ['post' => $post]);
    }
}
