<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surf_Maps;
use App\Models\Surf_Users;

class SurfController extends Controller
{
    public function index()
    {
        $surfMaps = Surf_Maps::all(); // Fetch all surf maps from the database
        return view('index', compact('surfMaps'));
    }
    public function addMap()
    {
        return view('add-map');
    }
    public function storeMap(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'status' => 'required|in:Active,Inactive',
            'tier' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // adjust image validation rules as needed
        ]);

        // Handle file upload and conversion to BLOB
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageData = file_get_contents($image->getRealPath());
        } else {
            // Handle if no image is uploaded (optional)
            $imageData = null;
        }

        // Create a new map entry
        $surfMap = new Surf_Maps();
        $surfMap->Name = $request->name;
        $surfMap->Status = $request->status;
        $surfMap->Tier = $request->tier;
        $surfMap->Image = $imageData; // store image data as BLOB
        $surfMap->save();

        // Redirect back to the index page or wherever you want
        return redirect('/');
    }

    public function getMapImage($id)
    {
        $surfMap = Surf_Maps::findOrFail($id);

        // Check if Image field exists and is not null
        if ($surfMap->Image) {
            // Determine MIME type of the image
            $mime = finfo_buffer(finfo_open(), $surfMap->Image, FILEINFO_MIME_TYPE);

            // Encode image data
            $image = base64_encode($surfMap->Image);
            $imageData = 'data:' . $mime . ';base64,' . $image;

            // Return response with correct MIME type
            return response()->make($imageData, 200, [
                'Content-Type' => $mime,
                'Content-Disposition' => 'inline; filename="' . $surfMap->Name . '.' . pathinfo($mime, PATHINFO_EXTENSION) . '"'
            ]);
        } else {
            abort(404); // or handle missing image as needed
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

}

