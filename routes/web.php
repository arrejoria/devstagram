<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PerfilController;

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

Route::get('/', HomeController::class)->name('home');

// Registrar Usuario
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

// Autenticar Usuario
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

// Rutas para el perfil 
Route::get('/editar-perfil', [PerfilController::class, 'index'])->name('perfil.index');
Route::post('/editar-perfil', [PerfilController::class, 'store'])->name('perfil.store');

// Muro e Informacion de Usuario
// Route Model Binding - Entre llaves crearemos una variable hacia el modelo user
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::delete('/posts/{post}',[PostController::class, 'destroy'])->name('posts.destroy');
Route::delete('/posts/{post}/edit',[PostController::class, 'edit'])->name('posts.edit');


// Comentario
Route::post('/{user:username}/posts/{post}', [ComentarioController::class, 'store'])->name('comentarios.store');
Route::delete('/{user:username}/posts/{post}/comentarios/{comentario}', [ComentarioController::class, 'destroy'])->name('comentarios.destroy');

// Followers
Route::post('/{user:username}/follow',[FollowerController::class, 'store'])->name('users.follow');
Route::delete('/{user:username}/follow',[FollowerController::class, 'destroy'])->name('users.unfollow');

// Almacenar imagenes
Route::post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store');

// Like a las fotos
Route::post('/posts/{post}/likes', [LikeController::class, 'store'])->name('posts.likes.store');
Route::delete('/posts/{post}/unlikes', [LikeController::class, 'destroy'])->name('posts.unlikes.destroy');

Route::get('/{user:username}', [PostController::class, 'index'])->name('post.index');
Route::get('/{user:username}/posts/{post}',[PostController::class, 'show'])->name('posts.show');
