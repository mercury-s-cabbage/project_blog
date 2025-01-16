<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trashed Posts</title>
</head>
<body color="blue">
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

<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            background-color: #f9f9f9;
            padding: 15px;
            margin-bottom: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h3 {
            margin: 0;
            font-size: 1.2em;
        }

        p {
            color: #555;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 8px;
            border-radius: 5px;
        }

        button:hover {
            background-color: #45a049;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #007BFF;
        }

    </style>
