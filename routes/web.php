<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

// Отображение всех постов
Route::get('/posts', function () {
    return view('posts.index');
});

// Для работы с AJAX-запросами:
Route::get('/posts/data', [PostController::class, 'index']);
Route::post('/posts/store', [PostController::class, 'store']);

Route::delete('/posts/{id}', [PostController::class, 'destroy']);
Route::put('/posts/{id}', [PostController::class, 'update']);

// Создание нового поста
Route::post('/posts', [PostController::class, 'store']);

// Публикация поста
Route::patch('/posts/{id}/publish', [PostController::class, 'publish']);
