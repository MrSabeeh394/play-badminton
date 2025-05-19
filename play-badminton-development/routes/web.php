<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResultController;

Route::get('home', function () {
    return view('error.not-access');
})->name('home');

Route::middleware(['auth', 'onlyAdmin', 'verified'])->group(function () {

    Route::get('/', [TeamController::class, 'showDashboard'])->name('dashboard');

    // Route::get('/dashboard', [TeamController::class, 'showDashboard'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::resource('teams', TeamController::class);
    Route::resource('players', PlayerController::class);
    Route::resource('events', EventController::class);
    Route::resource('matches', MatchController::class);
    Route::resource('results', ResultController::class);
    Route::get('/results/create/{match}', [ResultController::class, 'create'])->name('results.create');
    // Route::get('/events/type/{teamType}', [EventController::class, 'getTeamsByTeamType'])->name('events.getTeamsByTeamType');

    Route::get('/get-teams/{teamType}', [EventController::class, 'getTeams'])->name('teams.get');
});

require __DIR__ . '/auth.php';
