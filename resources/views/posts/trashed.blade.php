<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trashed Posts</title>
</head>
<body>
    <h1>Trashed Posts</h1>

    @if(session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    <ul>
        @foreach ($trashedPosts as $post)
            <li>
                <h3>{{ $post->title }}</h3>
                <p>{{ $post->content }}</p>
                <form action="{{ route('posts.restore', $post->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('PUT')
                    <button type="submit">Restore</button>
                </form>
            </li>
        @endforeach
    </ul>

    <a href="{{ route('posts.index') }}">Back to all posts</a>
</body>
</html>
