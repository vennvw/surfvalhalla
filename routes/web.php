<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurfController;
use Illuminate\Support\Facades\URL;

Route::get('/', [SurfController::class, 'index']);
Route::get('/add-map', [SurfController::class, 'addMap']);
Route::get('/add-moderator', [SurfController::class, 'addModerator']);
Route::get('/comment/{id}', [SurfController::class, 'comment']);
Route::get('/rate/{id}', [SurfController::class, 'rate']);
Route::post('/store-map', [SurfController::class, 'storeMap'])->name('store.map');
Route::get('/map/image/{id}', [SurfController::class, 'getMapImage'])->name('map.image');
Route::delete('/delete-map/{id}', [SurfController::class, 'deleteMap'])->name('delete.map');




URL::forceScheme('https');