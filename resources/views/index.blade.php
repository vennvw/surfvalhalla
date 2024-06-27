<!-- resources/views/index.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Surf Valhalla</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .map-box {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin: 10px;
            text-align: center;
        }
        .map-box img {
            width: 100%;
            height: auto;
            max-height: 200px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background-color: #f8f9fa;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <button class="btn btn-primary" onclick="window.location='{{ url("add-map") }}'">Add Map</button>
            <button class="btn btn-secondary" onclick="window.location='{{ url("add-moderator") }}'">Add Moderator</button>
        </div>
        
        <div class="row">
            @foreach ($surfMaps as $map)
                <div class="col-md-4">
                    <div class="map-box">
                        <img src="{{ route('map.image', ['id' => $map->id]) }}" alt="Map image">
                        <h4>{{ $map->Name }}</h4>
                        <p>Tier: {{ $map->Tier }}</p>
                        <p>Status: {{ $map->Status }}</p>
                        <button class="btn btn-primary" onclick="window.location='{{ url("comment/".$map->id) }}'">Comment</button>
                        <button class="btn btn-warning" onclick="window.location='{{ url("rate/".$map->id) }}'">Rate</button>
                        <form method="POST" action="{{ route('delete.map', ['id' => $map->id]) }}" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
