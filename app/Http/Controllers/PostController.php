<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Отображение всех постов.
     */
    public function index()
    {
        // Получение всех постов
        return response()->json(Post::all(), 200);
    }

    /**
     * Создание нового поста.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Ограничение на тип файла и размер
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $validated['image'] = $path;
        }

        $post = Post::create($validated);

        return response()->json($post, 201);
    }

    /**
     * Обновление поста.
     */
    public function update(Request $request, $id)
    {
        // Найти пост по ID
        $post = Post::findOrFail($id);

        // Валидация данных
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|required|string',
            'is_published' => 'sometimes|boolean',
            'publish_at' => 'nullable|date',
        ]);

        // Обновление поста
        $post->update($validated);

        return response()->json($post, 200);
    }

    /**
     * Удаление поста.
     */
    public function destroy($id)
    {
        // Найти пост по ID
        $post = Post::findOrFail($id);

        // Удалить пост
        $post->delete();

        return response()->json(['message' => 'Post deleted successfully'], 204);
    }

    /**
     * Публикация поста.
     */
    public function publish($id)
    {
        // Найти пост по ID
        $post = Post::findOrFail($id);

        // Обновить статус публикации
        $post->is_published = true;
        $post->publish_at = now();
        $post->save();

        return response()->json($post, 200);
    }
}
