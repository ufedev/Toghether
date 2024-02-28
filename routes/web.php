<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


// Perfil
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');

// Imagenes de Posts
Route::post('/image', [ImageController::class, 'store'])->name('image.store');
Route::delete('/image', [ImageController::class, 'delete'])->name('image.delete');

// Registro
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

// Logueo
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post("/logout", [LogoutController::class, 'store'])->name('logout');


// Posts 
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::delete('/posts/{post:url}', [PostController::class, 'destroy'])->name('posts.destroy');
// Likes a posts
Route::post('/posts/{post}/likes', [LikeController::class, 'store'])->name('posts.likes.store');


// Usuario
Route::get('/{user:username}', [PostController::class, 'index'])->name('posts.index');
Route::get("/{user:username}/posts/{post:url}", [PostController::class, 'show'])->name('posts.show');

// Seguidores
Route::post('/{user:username}/follow', [FollowerController::class, 'store'])->name('profile.follow');
Route::delete('/{user:username}/unfollow', [FollowerController::class, 'destroy'])->name('profile.unfollow');

// Comentarios
Route::post("/{user:username}/posts/{post:url}", [CommentController::class, 'store'])->name('comment.store');
