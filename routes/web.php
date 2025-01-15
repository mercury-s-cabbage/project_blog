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

// Создание нового поста
Route::post('/posts', [PostController::class, 'store']);

// Обновление поста
Route::put('/posts/{id}', [PostController::class, 'update']);

// Удаление поста
Route::delete('/posts/{id}', [PostController::class, 'destroy']);

// Публикация поста
Route::patch('/posts/{id}/publish', [PostController::class, 'publish']);
