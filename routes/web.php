<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;


Route::get('/posts', function () {
    return view('posts.index');
})->name('posts.index');

Route::get('/posts/data', [PostController::class, 'index']);
Route::post('/posts/store', [PostController::class, 'store']);

Route::delete('/posts/{id}', [PostController::class, 'destroy']);
Route::put('/posts/{id}', [PostController::class, 'update']);

Route::post('/posts', [PostController::class, 'store']);

Route::patch('/posts/{id}/publish', [PostController::class, 'publish']);

Route::get('/posts/trashed', [PostController::class, 'trashed'])->name('posts.trashed');
Route::put('/posts/{id}/restore', [PostController::class, 'restore'])->name('posts.restore');
