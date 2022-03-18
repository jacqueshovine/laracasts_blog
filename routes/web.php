<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {



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
        'posts' => Post::latest()->with('category', 'author')->get(),
        'categories' => Category::all(),
    ]);

});

Route::get('posts/{post}', function (Post $post) {

    return view('post', [
        'post' => $post
    ]);
    
});

// The syntax below would be used if we had not defined getRouteKeyName() function in the Post Model
// Route::get('posts/{post:slug}', function (Post $post) { // Post::where('slug', $post)->firstOrFail()

//     return view('post', [
//         'post' => $post
//     ]);
    
// });

Route::get('categories/{category}', function (Category $category) {
    return view('posts', [
        // load() solves the N+1 problem.
        'posts' => $category->posts->load(['category', 'author']),
        'currentCategory' => $category,
        'categories' => Category::all(),
    ]);
});

Route::get('authors/{author:username}', function (User $author) {
    return view('posts', [
        'posts' => $author->posts->load(['category', 'author']),
        'categories' => Category::all(),
    ]);
});