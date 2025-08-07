<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ActivityPublicController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ParticipantPublicController;
use App\Http\Controllers\ActivityTypePublicController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/activities', [ActivityPublicController::class, 'index'])->name('activities.index');
Route::get('/activities/{activity}', [ActivityPublicController::class, 'show'])->name('activities.show');
Route::get('/participants', [ParticipantPublicController::class, 'index'])->name('participants.index');
Route::get('/types', [ActivityTypePublicController::class, 'index'])->name('types.index');

Route::middleware('auth')->group(function () {
    Route::post('/activities/{activity}/toggle-favorite', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
    Route::get('/my-favorites', [FavoriteController::class, 'index'])->name('favorites.index');
});
