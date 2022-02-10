<?php

use App\Http\Controllers\JugadorController;
use App\Http\Controllers\PassportController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\PartidaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

    Route::get('login', [PassportController::class, 'createLogin'])->name('login');
    Route::get('register', [PassportController::class, 'createRegister'])->name('register');
    Route::post('login', [PassportController::class, 'login'])->name('login.store');
    Route::post('register', [PassportController::class, 'register'])->name('register.store'); 

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::middleware('auth:api')->group(function(){

    Route::get('players/{id}/games', [PartidaController::class, 'indexByJugador'])->name('vistaJugador');
    Route::get('players', [JugadorController::class, 'llistatJugadors'])->name('vistaAdmin'); 

    Route::post('players/{id}/games', [PartidaController::class, 'store'])->name('partides.store');
    Route::delete('players/{id}/games', [PartidaController::class, 'destroy'])->name('partides.destroy');
    Route::get('players/{id}', [JugadorController::class, 'edit'])->name('jugadors.edit');
    Route::put('players/{id}', [JugadorController::class, 'update'])->name('jugadors.update');
    Route::get('players/ranking', [JugadorController::class, 'percentatgeExitTotal'])->name('rankings.rankingTotals');
    Route::get('players/ranking/loser', [StatusController::class, 'rankingJugadorLoser'])->name('rankings.rankingLoser');
    Route::get('players/ranking/winner', [StatusController::class, 'rankingJugadorWinner'])->name('rankings.rankingWinner');

    Route::delete('logout', [PassportController::class, 'logout'])->name('logout');
});
