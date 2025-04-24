<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AccueilController;

// acceuil routing
Route::get('/', [AccueilController::class, 'index'])->name('accueil');

//annonce by id
Route::get('/annonces', [AccueilController::class, 'annonces'])->name('annonces');
// Route::get('/annonce/{id}', [AccueilController::class, 'annonceById'])->name('annonce');

//reservations
Route::get('/reservations', [AccueilController::class, 'reservations'])->name("reservations");


//profile
// Route::get('/profile', [AccueilController::class], 'profile')->name("/profile");
