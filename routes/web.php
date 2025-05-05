<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnnonceDetailsController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UtilisateurController;

use App\Http\Controllers\AccueilController;

//Partie Client - Sadki

// acceuil routing
Route::get('/', [AccueilController::class, 'index'])->name('accueil');

//annonce by id
Route::get('/annonces', [AccueilController::class, 'annonces'])->name('annonces');
//Route::get('/annonce/{id}', [AccueilController::class, 'annonceById'])->name('annonceID');

//reservations
Route::get('/reservations', [AccueilController::class, 'reservations'])->name("reservations");

//profile
// Route::get('/profile', [AccueilController::class], 'profile')->name("/profile");


//Partie Client - Nada
     //Details annonce
     Route::get('/annonces/{id}', [AnnonceDetailsController::class, 'show'])
         ->name('annonces.show');
     Route::post('/annonces/{annonce}/reserver', [ReservationController::class, 'store'])
         ->name('reservations.store');
     Route::get('/proprietaires/{id}', [UtilisateurController::class, 'show'])
         ->name('proprietaires.show');

//require __DIR__ . '/client.php';

