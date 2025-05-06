<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AccueilController;
use App\Http\Controllers\ReservationHistoriqueController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AnnonceDetailsController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\UtilisateurController;
use App\Models\Evaluation;
use App\Http\Controllers\ReclamationController;
use App\Http\Controllers\AnnonceController;


// acceuil routing
Route::get('/', [AccueilController::class, 'index'])->name('accueil');

//annonce
Route::get('/annonces', [AnnonceController::class, 'index'])->name('annonces');

//reservations
Route::get('/reservations', [ReservationHistoriqueController::class, 'reservations'])->name("reservations");

//Details annonce
Route::get('/annonces/{id}', [AnnonceDetailsController::class, 'show'])->name('annonceID');
Route::post('/reservation', [ReservationController::class, 'store'])->name('reservation.store')->middleware('auth');
Route::get('/utilisateur/surnom/{id}', [UtilisateurController::class,'getSurnom']);


//evaluation annonce
Route::get('/evaluation_annonce/{reservation}', [EvaluationController::class, 'create'])->name('evaluations.create');    
Route::post('/evaluation_annonce', [EvaluationController::class, 'store'])->name('evaluations.store');

//Reclamation 
Route::get('/client/reclamations', [ReclamationController::class, 'index'])->name('client.reclamations');
Route::middleware(['auth'])->group(function () {
    Route::get('/reclamations', [ReclamationController::class, 'index'])->name('reclamations.index');
    Route::post('/reclamations', [ReclamationController::class, 'store'])->name('reclamations.store');
});


// // Auth redirect for email links
// Route::get('/evaluations/{reservation}/redirect', function (Reservation $reservation) {
//     return redirect()->route('login', [
//         'redirect' => route('evaluations.create', $reservation)
//     ]);
// })->name('evaluations.redirect');
//profile
// Route::get('/profile', [AccueilController::class], 'profile')->name("/profile");
