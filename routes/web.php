<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BonController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\VehiculeController;
use App\Http\Controllers\PreneurController;

Route::get('/', function () {
    return view('acce');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/bons', [BonController::class, 'index']);
Route::resource('bons', BonController::class);
Route::get('/saisi', [BonController::class, 'create'])->name('saisi.create');
Route::post('/saisi', [BonController::class, 'store'])->name('saisi.store');

Route::middleware(['auth', 'admin'])->group(function () {
Route::resource('sites', SiteController::class);
Route::resource('srevices', ServiceController::class);
Route::resource('vehicules', VehiculeController::class);
Route::resource('preneurs', PreneurController::class);
});
Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

require __DIR__.'/auth.php';
