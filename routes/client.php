<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AccueilController;
use App\Http\Controllers\ReservationHistoriqueController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AnnonceDetailsController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\ReclamationController;
use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PartenaireController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\Partenaire_clientController;
use App\Http\Controllers\ClientStatsController;



// ========================
// Public Routes
// ========================

// Accueil - accessible to all
Route::get('/', [AccueilController::class, 'index'])->name('acceuil');

// Authentication - registration & login
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Authentication - login only
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
});

// Surnom public access
Route::get('/utilisateur/surnom/{id}', [UtilisateurController::class,'getSurnom']);

// Paiement - public access
Route::get('/paiement', [PaiementController::class, 'show'])->name('paiement.show');
Route::post('/paiement/process', [PaiementController::class, 'process'])->name('paiement.process');

// ========================
// Protected Routes - User Must Be Logged In
// ========================
Route::middleware(['auth'])->group(function () {

    // Accès aux annonces & réservations
    Route::get('/annonces', [AnnonceController::class, 'index'])->name('annonces');
    Route::get('/annonces/{id}', [AnnonceDetailsController::class, 'show'])->name('annonceID');
    Route::get('/reservations', [ReservationHistoriqueController::class, 'reservations'])->name("reservations");
    Route::post('/reservation', [ReservationController::class, 'store'])->name('reservation.store');

    // Évaluation
    Route::get('/evaluation_annonce/{reservation}', [EvaluationController::class, 'create'])->name('evaluations.create');    
    Route::post('/evaluation_annonce', [EvaluationController::class, 'store'])->name('evaluations.store');

    // Réclamations

    Route::get('/client/reclamations', [ReclamationController::class, 'index'])->name('client.reclamations');
    Route::middleware(['auth'])->group(function () {
        Route::get('/reclamations', [ReclamationController::class, 'index'])->name('reclamations');
        Route::post('/reclamations', [ReclamationController::class, 'store'])->name('reclamations.store');
    });
Route::middleware('auth')->group(function () {
    Route::post('/profile/update-image', [ProfileController::class, 'updateImage']);
    Route::post('/profile/update-password', [ProfileController::class, 'updatePassword']);
    Route::post('/profile/update-info', [ProfileController::class, 'updateInfo']);
    Route::post('/logout', [ProfileController::class, 'logout']);
});

    // Espace client
    Route::get('/client/acceuil', [HomeController::class, 'clientHome'])->name('client.acceuil');

    // Client spécifique : réclamations visibles
    Route::get('/client/reclamations', [ReclamationController::class, 'index'])->name('client.reclamations');

    // Espace home + switch rôle
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('/switch-role', [PartenaireController::class, 'switchRole'])->name('switch.role');
    Route::get('/check-contract', [PartenaireController::class, 'checkContractStatus'])->name('partenaire.check');

    // Espace partenaire
    Route::get('/partenaire/home', [HomeController::class, 'partenaireHome'])
        ->name('partenaire.home')
        ->middleware('role:propriétaire');

    // Routes spécifiques aux clients
    Route::middleware(\App\Http\Middleware\CheckRole::class . ':client')->group(function () {
        Route::get('/devenir-partenaire', [PartenaireController::class, 'showContrat'])->name('partenaire.contrat');
        Route::post('/devenir-partenaire', [PartenaireController::class, 'devenirPartenaire'])->name('partenaire.valider');
    });

    #stats
Route::get('/client/stats', [ClientStatsController::class, 'show'])->name('stats');

});

// ========================
// Admin Routes - Protected by 'auth:admin'
// ========================
Route::prefix('admin')->middleware(['auth:admin'])->name('admin.')->group(function () {

    // Admin logout
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Clients
    Route::get('/clients', [Partenaire_clientController::class, 'indexClients'])->name('clients');
    Route::post('/clients/{client}/toggle-status', [Partenaire_clientController::class, 'toggleStatusClient'])->name('clients.toggle-status');

    // Partenaires
    Route::get('/partenaires', [Partenaire_clientController::class, 'indexPartenaires'])->name('partenaires');
    Route::post('/partenaires/{partenaire}/toggle-status', [Partenaire_clientController::class, 'toggleStatusPartenaire'])->name('partenaires.toggle-status');


    Route::get('/commentaires', [CommentaireController::class, 'index'])->name('commentaires');
    Route::get('/commentaires/{id}', [CommentaireController::class, 'show'])->name('commentaires.show');
    Route::post('/commentaires/{id}/approve', [CommentaireController::class, 'approve'])->name('commentaires.approve'); 
    Route::delete('/commentaires/{id}', [CommentaireController::class, 'destroy'])->name('commentaires.destroy');


    Route::get('/paiements', [\App\Http\Controllers\Admin\PaiementController::class, 'index'])
    ->name('paiements');

Route::get('/paiements/export', [\App\Http\Controllers\Admin\PaiementController::class, 'export'])
    ->name('paiements.export');


    Route::prefix('annonces')->group(function() {
        Route::get('/', [\App\Http\Controllers\Admin\AnnonceController::class, 'index'])->name('annonces.index');
        Route::get('/{annonce}', [\App\Http\Controllers\Admin\AnnonceController::class, 'show'])->name('annonces.show');
    });
    
    Route::prefix('reservations')->group(function() {
        Route::get('/', [\App\Http\Controllers\Admin\ReservationController::class, 'index'])->name('reservations.index');
        Route::get('/{reservation}', [\App\Http\Controllers\Admin\ReservationController::class, 'show'])->name('reservations.show');
    });

    Route::prefix('reclamations')->name('reclamations.')->group(function () {
        Route::get('/', [ReclamationController::class, 'index'])->name('index');
        Route::get('/{reclamation}', [ReclamationController::class, 'show'])->name('show');
        Route::post('/{reclamation}/repondre', [ReclamationController::class, 'repondre'])->name('repondre');
        Route::get('/{reclamation}/download', [ReclamationController::class, 'downloadPieceJointe'])->name('download');
    });
// routes/web.php




 Route::prefix('categories')->group(function() {
        Route::get('/', [CategorieController::class, 'index'])->name('categories.index');
        Route::get('/create', [CategorieController::class, 'create'])->name('categories.create');
        Route::post('/', [CategorieController::class, 'store'])->name('categories.store');
        Route::get('/{categorie}', [CategorieController::class, 'show'])->name('categories.show');
        Route::get('/{categorie}/edit', [CategorieController::class, 'edit'])->name('categories.edit');
        Route::put('/{categorie}', [CategorieController::class, 'update'])->name('categories.update');
        Route::delete('/{categorie}', [CategorieController::class, 'destroy'])->name('categories.destroy');
    });

});