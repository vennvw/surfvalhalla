<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surf_Maps;
use App\Models\Surf_Users;
use App\Models\Comments;
use App\Models\Ratings;

class SurfController extends Controller
{
    public function index()
    {
        $surfMaps = Surf_Maps::with('ratings')->get();

        foreach ($surfMaps as $map) {
            $map->average_rating = $map->ratings->avg('Star_Value');
        }

        return view('index', compact('surfMaps'));
    }

    public function addMap()
    {
        return view('add-map');
    }

    public function storeMap(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'status' => 'required|in:Active,Inactive',
            'tier' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:51200',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageData = file_get_contents($image->getRealPath());
        } else {
            $imageData = null;
        }

        $surfMap = new Surf_Maps();
        $surfMap->Name = $request->name;
        $surfMap->Status = $request->status;
        $surfMap->Tier = $request->tier;
        $surfMap->Image = $imageData; // store image data as BLOB
        $surfMap->save();

        return redirect('/');
    }

    public function getMapImage($id)
    {
        $surfMap = Surf_Maps::findOrFail($id);

        if ($surfMap->Image) {
            $mime = finfo_buffer(finfo_open(), $surfMap->Image, FILEINFO_MIME_TYPE);
            $imageData = base64_encode($surfMap->Image);

            return response()->json([
                'mime' => $mime,
                'data' => $imageData
            ]);
        } else {
            abort(404);
        }
    }

    public function deleteMap($id)
    {
        $surfMap = Surf_Maps::findOrFail($id);
        $surfMap->delete();

        return redirect()->back()->with('success', 'Map deleted successfully');
    }

    public function addModerator()
    {
        $users = Surf_Users::all();
        return view('add-admin', compact('users'));
    }

    public function comment($id)
    {
        $map = Surf_Maps::findOrFail($id);
        return view('comments', compact('map'));
    }

    public function storeComment(Request $request)
    {
        $request->validate([
            'map_id' => 'required|exists:surf_maps,id',
            'comment' => 'required|string',
        ]);

        Comments::create([
            'surf_maps_id' => $request->map_id,
            'surf_users_id' => auth()->id(),
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Comment added successfully.');
    }

    public function storeRating(Request $request)
    {
        $request->validate([
            'map_id' => 'required|exists:surf_maps,id',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $userId = auth()->id();
        $mapId = $request->map_id;
        $ratingValue = $request->rating;

        $rating = Ratings::updateOrCreate(
            ['surf_users_id' => $userId, 'surf_maps_id' => $mapId],
            ['Star_Value' => $ratingValue]
        );

        return redirect()->back()->with('success', 'Rating submitted successfully.');
    }
    public function getMap(Request $request)
    {
        $map = Surf_Maps::findOrFail($request->map_id);
        return response()->json($map);
    }
    public function updateMap(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'status' => 'required|in:Active,Inactive',
            'tier' => 'required|string',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:51200',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageData = file_get_contents($image->getRealPath());
        } else {
            $imageData = null;
        }

        $surfMap = Surf_Maps::findOrFail($request->map_id);
        $surfMap->Name = $request->name;
        $surfMap->Status = $request->status;
        $surfMap->Tier = $request->tier;
        
        if ($imageData !== null) {
            $surfMap->Image = $imageData;
        }

        $surfMap->save();

        return redirect('/');
    }
}
