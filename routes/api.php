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

    Route::get('players/{id}/games', [PartidaController::class, 'indexByJugador'])->middleware('can:vista.jugador')->name('vistaJugador');
    Route::get('players', [JugadorController::class, 'llistatJugadors'])->middleware('can:vistaAdmin')->name('vistaAdmin'); 

    Route::post('players/{id}/games', [PartidaController::class, 'store'])->name('partides.store');
    Route::delete('players/{id}/games', [PartidaController::class, 'destroy'])->name('partides.destroy');
    Route::get('players/{id}/edit', [JugadorController::class, 'edit'])->middleware('can:edit.nickname')->name('jugadors.edit');
    Route::put('players/{id}', [JugadorController::class, 'update'])->middleware('can:update.nickname')->name('jugadors.update');
    Route::get('players/ranking', [JugadorController::class, 'percentatgeExitTotal'])->middleware('can:rankingtotal')->name('rankingTotals');
    Route::get('players/ranking/loser', [StatusController::class, 'rankingLoser'])->middleware('can:rankingWinner')->name('rankingLoser');
    Route::get('players/ranking/winner', [StatusController::class, 'rankingWinner'])->middleware('can:rankingLoser')->name('rankingWinner');

    Route::delete('logout', [PassportController::class, 'logout'])->name('logout');
});
