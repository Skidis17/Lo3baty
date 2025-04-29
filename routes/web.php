<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnnonceDetailsController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UtilisateurController;

Route::get('/', function () {
    return view('welcome');
});


//Partie Client
     //Details annonce
     Route::get('/annonces/{id}', [AnnonceDetailsController::class, 'show'])
         ->name('annonces.show');
     Route::post('/annonces/{annonce}/reserver', [ReservationController::class, 'store'])
         ->name('reservations.store');
     Route::get('/proprietaires/{id}', [UtilisateurController::class, 'show'])
         ->name('proprietaires.show');

require __DIR__ . '/client.php';

