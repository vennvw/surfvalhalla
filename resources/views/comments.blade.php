<!-- comments.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Comments</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .comment-box {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Comments for Map: {{ $map->Name }}</h2>

        {{-- Form to add new comment --}}
        @auth
            <form method="POST" action="{{ route('store.comment') }}">
                @csrf
                <input type="hidden" name="map_id" value="{{ $map->id }}">
                <div class="form-group">
                    <label for="comment">Write your comment:</label>
                    <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        @else
            <p>Please <a href="{{ route('login') }}">login</a> to add a comment.</p>
        @endauth


        {{-- Display existing comments --}}
        @foreach ($map->comments as $comment)
            <div class="comment-box">
                <p>{{ $comment->comment }}</p>
                <small>By: {{ optional($comment->Surf_Users)->Username ?? 'Unknown User' }}</small>
            </div>
        @endforeach
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
