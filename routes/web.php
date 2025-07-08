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




Route::resource('sites', SiteController::class);


Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{service}/edit', [ServiceController::class, 'edit'])->name('services.edit');
Route::put('/services/{service}', [ServiceController::class, 'update'])->name('services.update');
Route::delete('/services/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');

Route::get('/vehicules/create', [VehiculeController::class, 'create'])->name('vehicules.create');
Route::post('/vehicules', [VehiculeController::class, 'store'])->name('vehicules.store');
Route::get('/vehicules', [VehiculeController::class, 'index'])->name('vehicules.index');
Route::get('/vehicules/{vehicule}/edit', [VehiculeController::class, 'edit'])->name('vehicules.edit');
Route::put('/vehicules/{vehicule}', [VehiculeController::class, 'update'])->name('vehicules.update');
Route::delete('/vehicules/{vehicule}', [VehiculeController::class, 'destroy'])->name('vehicules.destroy'); 


Route::resource('preneurs', PreneurController::class);

Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

require __DIR__.'/auth.php';
