<?php

use App\Http\Controllers\PostController;
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

Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('posts/{post}', [PostController::class, 'show']);

// The syntax below would be used if we had not defined getRouteKeyName() function in the Post Model
// Route::get('posts/{post:slug}', function (Post $post) { // Post::where('slug', $post)->firstOrFail()

//     return view('post', [
//         'post' => $post
//     ]);
    
// });

// Old way of displaying posts per categories (with dedicated category page).

// Route::get('categories/{category}', function (Category $category) {
//     return view('posts', [
//         // load() solves the N+1 problem.
//         'posts' => $category->posts->load(['category', 'author']),
//         'currentCategory' => $category,
//         'categories' => Category::all(),
//     ]);
// })->name('category');

Route::get('authors/{author:username}', function (User $author) {
    return view('posts', [
        'posts' => $author->posts->load(['category', 'author']),
    ]);
});