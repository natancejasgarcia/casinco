<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\JuegoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::post('/ganar-money', [UserController::class, 'ganarMoney'])->name('ganar.money')->middleware('auth');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/juego', [JuegoController::class, 'mostrarJuego'])->name('juego.mostrar');
    Route::post('/juego/apostar', [JuegoController::class, 'procesarApuesta'])->name('juego.apostar');
    Route::get('/juego-adivinar', [JuegoController::class, 'mostrarVistaJuego'])->name('guessnumber');
    Route::post('/juego/jugar', [JuegoController::class, 'jugar'])->name('juego.jugar');
});

require __DIR__ . '/auth.php';
