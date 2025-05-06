<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AccueilController;
use App\Http\Controllers\AnnonceDetailsController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UtilisateurController;

// acceuil routing
Route::get('/', [AccueilController::class, 'index'])->name('accueil');

//annonce by id
Route::get('/annonces', [AccueilController::class, 'annonces'])->name('annonces');
// Route::get('/annonce/{id}', [AccueilController::class, 'annonceById'])->name('annonce');

//reservations
Route::get('/reservations', [AccueilController::class, 'reservations'])->name("reservations");


//profile
// Route::get('/profile', [AccueilController::class], 'profile')->name("/profile");

//Partie Client
     //Details annonce
     Route::get('/annonces/{id}', [AnnonceDetailsController::class, 'show'])
         ->name('annonce.details');
     Route::post('/reservation', [ReservationController::class, 'store'])
         ->name('reservation.store')->middleware('auth');
     Route::get('/utilisateur/surnom/{id}', [UtilisateurController::class, 'getSurnom']);