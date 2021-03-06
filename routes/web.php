<?php

use App\Http\Controllers\AdminsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/post/{post}', [PostController::class, 'show'])->name('post');

Route::middleware('auth')->group(function(){

    Route::get('/admin', [AdminsController::class, 'index'])->name('admin.index');
    Route::get('/admin/posts', [PostController::class, 'index'])->name('post.index');
    Route::post('/admin/posts', [PostController::class, 'store'])->name('post.store');
    Route::get('/admin/posts/create', [PostController::class, 'create'])->name('post.create');
    Route::delete('/admin/posts/{post}/delete', [PostController::class, 'delete'])->name('post.delete');

    Route::patch('/admin/posts/{post}/update', [PostController::class, 'update'])->name('post.update');

});
    //can:view,post, added midleware - can - so you can only if policy view is ok, post is the model, you have to pass it to the policy
    Route::get('/admin/posts/{post}/edit', [PostController::class, 'edit'])->middleware('can:view,post')->name('post.edit');

    Route::get('admin/users/{user}/profile', [UserController::class, 'show'])->name('user.profile.show');
    Route::put('admin/users/{user}/update', [UserController::class, 'update'])->name('user.profile.update');
    Route::get('admin/users', [UserController::class, 'index'])->name('users.index');
