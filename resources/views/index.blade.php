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
            <div>
                @auth
                    @if(auth()->user()->Role === 'admin')
                        <button class="btn btn-primary" onclick="window.location='{{ url("add-map") }}'">Add Map</button>
                        <button class="btn btn-secondary" onclick="window.location='{{ url("add-moderator") }}'">Add Moderator</button>
                    @endif
                @endauth
            </div>
            <div>
                @guest
                    <a href="{{ route('register') }}" class="btn btn-success mr-2">Register</a>
                    <a href="{{ route('login') }}" class="btn btn-info">Login</a>
                @endguest
                @auth
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
                @endauth
            </div>
        </div>
        
        <div class="row">
            @foreach ($surfMaps as $map)
                <div class="col-md-4">
                    <div class="map-box">
                        <img id="map-image-{{ $map->id }}" src="" alt="Map image">
                        <h4>{{ $map->Name }}</h4>
                        <p>Tier: {{ $map->Tier }}</p>
                        <p>Status: {{ $map->Status }}</p>
                        <p>Rating: {{ $map->average_rating ?? 'No ratings yet' }}</p>
                        <button class="btn btn-primary" onclick="window.location='{{ url("comment/".$map->id) }}'">Comment</button>
                        @auth
                            <button class="btn btn-warning" onclick="showRatingModal({{ $map->id }})">Rate</button>
                        @else
                            <button class="btn btn-warning" onclick="window.location='{{ route("login") }}'">Rate</button>
                        @endauth
                        @auth
                            @if(auth()->user()->Role === 'admin')
                                <form method="POST" action="{{ route('delete.map', ['id' => $map->id]) }}" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                                <button class="btn btn-info" onclick="showEditModal({{ $map->id }}, '{{ $map->Name }}', '{{ $map->Tier }}', '{{ $map->Status }}')">Edit</button>
                            @endif
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Rating Modal -->
    <div class="modal fade" id="ratingModal" tabindex="-1" role="dialog" aria-labelledby="ratingModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ratingModalLabel">Rate Map</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="ratingForm" method="POST" action="{{ route('store.rating') }}">
                        @csrf
                        <input type="hidden" name="map_id" id="ratingMapId">
                        <div class="form-group">
                            <label for="rating">Rating</label>
                            <select class="form-control" id="rating" name="rating" required>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Rating</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Map</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST" action="{{ route('update.map') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="map_id" id="editMapId">
                        <div class="form-group">
                            <label for="editName">Name</label>
                            <input type="text" class="form-control" id="editName" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="editTier">Tier</label>
                            <input type="text" class="form-control" id="editTier" name="tier" required>
                        </div>
                        <div class="form-group">
                            <label for="editStatus">Status</label>
                            <select class="form-control" id="editStatus" name="status" required>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editImage">Image</label>
                            <input type="file" class="form-control-file" id="editImage" name="image">
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // Load map images via AJAX
            @foreach ($surfMaps as $map)
                $.ajax({
                    url: "{{ route('map.image', ['id' => $map->id]) }}",
                    method: 'GET',
                    success: function(data) {
                        $('#map-image-{{ $map->id }}').attr('src', 'data:' + data.mime + ';base64,' + data.data);
                    },
                    error: function() {
                        console.error('Failed to load image for map ID: {{ $map->id }}');
                    }
                });
            @endforeach
        });

        function showRatingModal(mapId) {
            // Set map ID for rating modal
            $('#ratingMapId').val(mapId);
            $('#ratingModal').modal('show');
        }
        function showEditModal(mapId, name, tier, status) {
            $('#editMapId').val(mapId);
            $('#editName').val(name);
            $('#editTier').val(tier);
            $('#editStatus').val(status);
            $('#editModal').modal('show');
        }

    </script>
</body>
</html>
