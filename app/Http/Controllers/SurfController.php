<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surf_Maps;

class SurfController extends Controller
{
    public function index()
    {
        $surfMaps = Surf_Maps::all(); // Fetch all surf maps from the database
        return view('index', compact('surfMaps'));
    }

    // Other methods for add-map, add-moderator, comment, and rate can be added here
}

