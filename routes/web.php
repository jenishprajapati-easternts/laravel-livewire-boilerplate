<?php

use App\Http\Livewire\Categories\Categories;
use App\Http\Livewire\Categories\Categoryposts;
use App\Http\Livewire\Posts\Posts;
use App\Http\Livewire\Posts\Post as p;
use App\Http\Livewire\Tags\Tagposts;
use App\Http\Livewire\Tags\Tags;
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

Route::get('/', function () {
    return view('welcome');
});

//user routes..
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'adminAuth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

//admin routes..
Route::middleware(['adminAuth'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin-dashboard');

    Route::get('/admin/categories', Categories::class)->name('categories');
    Route::get('/admin/categories/{id}/posts', Categoryposts::class);

    Route::get('/admin/posts', Posts::class)->name('posts');
    Route::get('/admin/posts/{id}', p::class);

    Route::get('/admin/tags', Tags::class)->name('tags');
    Route::get('/admin/tags/{id}/posts', Tagposts::class);
});