<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TeamController;
use App\Http\Controllers\Api\PlayerController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\MatchController;
use App\Http\Controllers\Api\ResultController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RegisteredUserController;
use App\Http\Controllers\Api\Auth\AuthenticatedSessionController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Route::get('available-teams', [TeamController::class, 'availableTeams'])->middleware('auth:sanctum');

Route::post('register', [RegisteredUserController::class, 'store']);
Route::post('login', [AuthenticatedSessionController::class, 'store']);

Route::middleware('auth:sanctum')->group(callback: function (): void {
    Route::post('logout', [LogoutController::class, 'store']);
    Route::apiResource('players', PlayerController::class);
    Route::apiResource('teams', TeamController::class);
    Route::get('team/available-teams', [TeamController::class, 'availableTeams']);

    Route::apiResource('events', EventController::class);
    Route::apiResource('matches', MatchController::class);
    Route::apiResource('results', ResultController::class);
    Route::get('/get-teams', [EventController::class, 'getTeams'])->name('teams.get');
});


