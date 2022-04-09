<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
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

Route::get('ping', function () {

    $mailchimp = new \MailchimpMarketing\ApiClient();

    $mailchimp->setConfig([
        'apiKey' => config('services.mailchimp.key'),
        'server' => 'us14',
    ]);

    $response = $mailchimp->lists->addListMember('5895ae2907', [
        'email_address' => 'jacqueshovine@gmail.com',
        'status' => 'subscribed'
    ]);

    // 5895ae2907

    // $response = $mailchimp->lists->getAllLists();

    dd($response);
});

Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('posts/{post}', [PostController::class, 'show']);
Route::post('posts/{post}/comments', [PostCommentsController::class, 'store']);

// Middleware : Piece of logic that will be run when a new request comes in (will inspect requests going through the core of the app, and perform actions)
// Laravel has a middleware called guest. Middlewares can be found in app/Http/Middleware
Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('login', [SessionsController::class, 'create'])->middleware('guest');
Route::post('login', [SessionsController::class, 'store'])->middleware('guest');
Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');

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


// Not needed anymore : we now filter through the controller using parameters

// Route::get('authors/{author:username}', function (User $author) {
//     return view('posts.index', [
//         'posts' => $author->posts->load(['category', 'author']),
//     ]);
// });