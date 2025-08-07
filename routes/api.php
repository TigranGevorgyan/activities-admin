<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ActivityController;
use App\Http\Controllers\Api\ParticipantController;
use App\Http\Controllers\Api\ActivityTypeController;
use App\Http\Controllers\Api\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::get('/activities', [ActivityController::class, 'index']);
    Route::get('/activities/{activity}', [ActivityController::class, 'show']);

    Route::get('/participants', [ParticipantController::class, 'index']);
    Route::get('/activity-types', [ActivityTypeController::class, 'index']);

    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{user}/favorites', [UserController::class, 'favorites']);
});
