<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PartenaireController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\CommentaireController;
Route::get('/', function () {
    return view('welcome');
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
     ->middleware('auth', 'role:partenaire');
     

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




use App\Http\Controllers\Admin\Partenaire_clientController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\ReclamationController; 
use App\Http\Controllers\Admin\CategorieController;
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
Route::get('/client/accueil', function () {
    return view('client.accueil');
});
