<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BonController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\VehiculeController;
use App\Http\Controllers\PreneurController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;


Route::get('/', function () {
    return view('acce');
});

Route::get('/profile',[BonController::class,'profile']);
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

Route::get('/resultat/impressionM/{matricule}', [BonController::class, 'printM'])->name('bons.printM');
Route::get('/resultat/impressionV/{vehicule}', [BonController::class, 'printV'])->name('bons.printV');
Route::get('/resultat/impressionB/{bon}', [BonController::class, 'printB'])->name('bons.printB');
Route::get('/bons/impression', [BonController::class, 'printT'])->name('bons.printT');

Route::get('/impression/par-site', [BonController::class, 'filtrerParSite'])->name('impression.site');
Route::post('/impression/par-site', [BonController::class, 'resultatParSite'])->name('impression.site.result');

Route::get('/impression/par-service', [BonController::class, 'filtrerParService'])->name('impression.service');
Route::post('/impression/par-service', [BonController::class, 'resultatParService'])->name('impression.service.result');

Route::get('/impression/filtrer-bon', [BonController::class, 'filtrerParbon'])->name('impression.bon');
Route::post('/impression/saisie-periode', [BonController::class, 'saisirParPeriode'])->name('impression.bon.result');

Route::get('/impression/filtrer-preneur', [BonController::class, 'filtrerParpreneur'])->name('impression.preneur');
Route::post('/impression/resultats-preneurs', [BonController::class, 'ResultatParPreneur'])->name('impression.preneurs.results');

Route::get('/impression/filtrer-vehicules', [BonController::class, 'filtrerParVehicule'])->name('impression.vehicule');
Route::post('/impression/resultats-vehicules', [BonController::class, 'TablePrintVehicule'])->name('impression.vehicules.result');
Route::get('/impression/resultats-vehicules/pdf', [BonController::class, 'exportVehiculePDF'])->name('impression.vehicules.pdf');
Route::get('/impression/resultats-site/pdf', [BonController::class, 'exportSitePDF'])->name('impression.sites.pdf');
Route::get('/impression/resultats-service/pdf', [BonController::class, 'exportServicePDF'])->name('impression.services.pdf');
Route::get('/impression/resultats-preneurs/pdf', [BonController::class, 'exportPreneursPDF'])->name('impression.preneurs.pdf');
Route::get('/impression/saisie-periode/pdf', [BonController::class, 'exportSaisiePeriodePDF'])->name('impression.saisie-periode.pdf');
Route::get('/impression/acceuil/pdf', [BonController::class, 'exportAcceuilPDF'])->name('impression.acceuil.pdf');

Route::get('/bons', [BonController::class, 'index']);
Route::resource('bons', BonController::class);
Route::get('/saisi', [BonController::class, 'create'])->name('saisi.create');
Route::post('/saisi', [BonController::class, 'store'])->name('saisi.store');

Route::resource('sites', SiteController::class);
Route::resource('services', ServiceController::class);
Route::resource('vehicules', VehiculeController::class);
Route::resource('preneurs', PreneurController::class);
Route::resource('users', UserController::class);

Route::get('/recherche/matricule', [BonController::class, 'rechercherParMatricule'])->name('recherche.matricule');
Route::get('/resultat/matricule', [BonController::class, 'resultatParMatricule'])->name('resultatM.matricule');

Route::get('/recherche/vehicule', [BonController::class, 'rechercherParVehicule'])->name('recherche.vehicule');
Route::get('/resultat/vehicule', [BonController::class, 'resultatParVehicule'])->name('resultatV.vehicule');

Route::get('/recherche/bon', [BonController::class, 'rechercherParNBon'])->name('recherche.bon');
Route::get('/resultat/bon', [BonController::class, 'resultatParNBon'])->name('resultatB.bon');

Route::get('/support', function () {
    return view('support');
})->name('support');

Route::get('/test-dashboard', [DashboardController::class, 'test']);
Route::get('/export-bons', [BonController::class, 'exportCSV']);


Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])->name('logout');

require __DIR__.'/auth.php';
