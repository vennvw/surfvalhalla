<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurfController;

Route::get('/', [SurfController::class, 'index']); // Route for the index page
Route::get('/add-map', [SurfController::class, 'addMap']); // Route for add map
Route::get('/add-moderator', [SurfController::class, 'addModerator']); // Route for add moderator
Route::get('/comment/{id}', [SurfController::class, 'comment']); // Route for comment
Route::get('/rate/{id}', [SurfController::class, 'rate']); // Route for rate
