<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FollowersController;
use App\Http\Controllers\TweetController;
use App\Models\Followers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('/tweet', TweetController::class);
    Route::post('/follow/{id}', [FollowersController::class, 'store']);
    Route::delete('/follow/{id}', [FollowersController::class, 'destroy']);
    Route::get('/followers', [FollowersController::class, 'followers']);
    Route::get('/following', [FollowersController::class, 'following']);
    Route::get('/suggested', [FollowersController::class, 'suggested']);

});
