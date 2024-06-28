<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurfController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;


Route::get('/', [SurfController::class, 'index'])->name('index');
Route::get('/add-map', [SurfController::class, 'addMap']);
Route::get('/add-moderator', [SurfController::class, 'addModerator']);
Route::get('/comment/{id}', [SurfController::class, 'comment']);
Route::get('/rate/{id}', [SurfController::class, 'rate']);
Route::post('/store-map', [SurfController::class, 'storeMap'])->name('store.map');
Route::get('/map/image/{id}', [SurfController::class, 'getMapImage'])->name('map.image');
Route::delete('/delete-map/{id}', [SurfController::class, 'deleteMap'])->name('delete.map');

Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);

Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::put('update-user-role/{id}', [UserController::class, 'updateUserRole'])->name('update.user.role');
Route::delete('delete-user/{id}', [UserController::class, 'deleteUser'])->name('delete.user');
Route::get('add-admin', [SurfController::class, 'addModerator'])->name('add.admin');

Route::get('/comment/{id}', [SurfController::class, 'comment'])->name('comment');
Route::post('/store-comment', [SurfController::class, 'storeComment'])->name('store.comment');

Route::post('/store-rating', [SurfController::class, 'storeRating'])->name('store.rating');

Route::get('/get-map', [SurfController::class, 'getMap'])->name('get.map');
Route::put('/update-map', [SurfController::class, 'updateMap'])->name('update.map');


