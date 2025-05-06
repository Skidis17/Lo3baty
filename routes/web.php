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
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PartenaireController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\Partenaire_clientController;


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

// Routes d'authentification
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', \App\Http\Middleware\CheckUserStatus::class])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('/switch-role', [PartenaireController::class, 'switchRole'])
    ->name('switch.role');
    Route::get('/check-contract', [PartenaireController::class, 'checkContractStatus'])
     ->name('partenaire.check');
     Route::get('/partenaire/home', [HomeController::class, 'partenaireHome'])
     ->name('partenaire.home')
     ->middleware('auth', 'role:propriétaire');
     

Route::get('/client/home', [HomeController::class, 'clientHome'])
     ->name('client.home')
     ->middleware('auth');
    // Seulement accessible aux clients
    Route::middleware(\App\Http\Middleware\CheckRole::class.':client')->group(function () {
        Route::get('/devenir-partenaire', [PartenaireController::class, 'showContrat'])
             ->name('partenaire.contrat');
        Route::post('/devenir-partenaire', [PartenaireController::class, 'devenirPartenaire'])
             ->name('partenaire.valider');
             
    });
});




// Routes publiques pour l'authentification admin
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
});

// Routes protégées - UN SEUL GROUPE ADMIN
Route::prefix('admin')->middleware(['auth:admin'])->name('admin.')->group(function () {
    // Déconnexion
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    // Tableau de bord
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Routes pour les clients
Route::get('/clients', [Partenaire_clientController::class, 'indexClients'])->name('clients');
Route::post('/clients/{client}/toggle-status', [Partenaire_clientController::class, 'toggleStatusClient'])->name('clients.toggle-status');

// Routes pour les partenaires
Route::get('/partenaires', [Partenaire_clientController::class, 'indexPartenaires'])->name('partenaires');
Route::post('/partenaires/{partenaire}/toggle-status', [Partenaire_clientController::class, 'toggleStatusPartenaire'])->name('partenaires.toggle-status');

});
// // Auth redirect for email links
// Route::get('/evaluations/{reservation}/redirect', function (Reservation $reservation) {
//     return redirect()->route('login', [
//         'redirect' => route('evaluations.create', $reservation)
//     ]);
// })->name('evaluations.redirect');
//profile
// Route::get('/profile', [AccueilController::class], 'profile')->name("/profile");
