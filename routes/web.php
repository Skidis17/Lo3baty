<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AccueilController;
use App\Http\Controllers\ReservationHistoriqueController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\Reservation;

// acceuil routing
Route::get('/', [AccueilController::class, 'index'])->name('accueil');

//annonce by id
Route::get('/annonces', [AccueilController::class, 'annonces'])->name('annonces');
Route::get('/annonce/{id}', [AccueilController::class, 'annonceById'])->name('annonceID');

//reservations
Route::get('/reservations', [ReservationHistoriqueController::class, 'reservations'])->name("reservations");





// Route::middleware(['auth'])->group(function () {
//     Route::get('/evaluations/{reservation}', [EvaluationController::class, 'create'])
//          ->name('evaluations.create')
//          ->middleware('can:evaluate,reservation');
    
//     Route::post('/evaluations', [EvaluationController::class, 'store'])
//          ->name('evaluations.store');
// });

// // Auth redirect for email links
// Route::get('/evaluations/{reservation}/redirect', function (Reservation $reservation) {
//     return redirect()->route('login', [
//         'redirect' => route('evaluations.create', $reservation)
//     ]);
// })->name('evaluations.redirect');
//profile
// Route::get('/profile', [AccueilController::class], 'profile')->name("/profile");
