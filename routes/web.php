<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
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

Route::prefix('post')->name('post.')->group(function(){
    Route::get('/',[PostController::class,'index'])->name('index');

    Route::get('/create',[PostController::class,'create'])->name('create');
    Route::post('/create/post',[PostController::class,'store'])->name('store');

    Route::get('/update/{id}',[PostController::class,'getUpdateById'])->name('updateId');
    Route::post('/update',[PostController::class,'update'])->name('update');

    Route::get('/delete/{id}',[PostController::class,'destroy'])->name('destroy');

});
Route::get('/', [PostController::class , 'home'])->name('home');

Route::get('posts/{post:slug}', [PostController::class , 'show']);
Route::post('posts/{post:slug}/comments', [PostCommentsController::class, 'store']);

Route::get('register', [RegisterController::class , 'create'])->middleware('guest');
Route::post('register', [RegisterController::class , 'store'])->middleware('guest');

Route::get('login', [SessionController::class , 'create'])->middleware('guest');
Route::post('login', [SessionController::class , 'store'])->middleware('guest');

Route::post('logout', [SessionController::class , 'destroy'])->middleware('auth');



