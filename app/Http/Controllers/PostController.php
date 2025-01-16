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
        try {
            $posts = Post::whereNull('deleted_at')->get(); // Только активные посты
            return response()->json($posts, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
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
        $post = Post::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post->update($validated);

        return response()->json($post);
    }

    /**
     * Удаление поста.
     */
    public function destroy($id)
    {
        try {
            $post = Post::findOrFail($id);
            $post->delete(); // Мягкое удаление
            return response()->json(['message' => 'Post deleted successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function restore($id)
{
    try {
        $post = Post::withTrashed()->findOrFail($id); // Находим удалённый пост
        $post->restore(); // Восстанавливаем пост
        return response()->json(['message' => 'Post restored successfully.', 'post' => $post], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
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
