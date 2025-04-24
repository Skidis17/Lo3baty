<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  
    public function up()
{
    Schema::create('utilisateur', function (Blueprint $table) {
        $table->id();
        $table->string('nom', 50);
        $table->string('prenom', 50);
        $table->string('email', 100)->unique();
        $table->string('mot_de_passe');
        $table->enum('role', ['client', 'proprietaire', 'autre']);
        $table->string('image_profil')->nullable();
        $table->string('cin_recto')->nullable();
        $table->string('cin_verso')->nullable();
        $table->dateTime('date_inscription')->useCurrent();  // Fix
    });

    Schema::create('admin', function (Blueprint $table) {
        $table->id();
        $table->string('nom', 50);
        $table->string('prenom', 50);
        $table->string('email', 100)->unique();
        $table->string('mot_pass');
    });

    Schema::create('categorie', function (Blueprint $table) {
        $table->id();
        $table->string('nom', 50);
    });

    Schema::create('objet', function (Blueprint $table) {
        $table->id();
        $table->string('nom', 100);
        $table->text('description')->nullable();
        $table->string('ville', 50);
        $table->decimal('prix_journalier', 10, 2);
        $table->enum('etat', ['neuf', 'bon etat', 'usage', 'a reparer']);
        $table->unsignedBigInteger('categorie_id');
        $table->unsignedBigInteger('proprietaire_id');
        $table->dateTime('date_ajout')->useCurrent();  // Fix

        $table->foreign('categorie_id')->references('id')->on('categorie');
        $table->foreign('proprietaire_id')->references('id')->on('utilisateur');
    });

    Schema::create('image', function (Blueprint $table) {
        $table->id();
        $table->string('url');
        $table->unsignedBigInteger('objet_id');

        $table->foreign('objet_id')->references('id')->on('objet')->onDelete('cascade');
    });

    Schema::create('annonce', function (Blueprint $table) {
        $table->id();
        $table->dateTime('date_publication')->useCurrent();  // Fix
        $table->date('date_debut');
        $table->date('date_fin');
        $table->enum('statut', ['disponible', 'indisponible', 'supprime'])->default('disponible');
        $table->boolean('premium')->default(false);
        $table->text('adresse');
        $table->unsignedBigInteger('objet_id');
        $table->unsignedBigInteger('proprietaire_id');

        $table->foreign('objet_id')->references('id')->on('objet');
        $table->foreign('proprietaire_id')->references('id')->on('utilisateur');
    });

    Schema::create('reservation', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('client_id');
        $table->unsignedBigInteger('annonce_id');
        $table->date('date_debut');
        $table->date('date_fin');
        $table->enum('statut', ['en attente', 'confirme', 'annule', 'termine'])->default('en attente');
        $table->dateTime('date_creation')->useCurrent();  // Fix

        $table->foreign('client_id')->references('id')->on('utilisateur');
        $table->foreign('annonce_id')->references('id')->on('annonce');
    });

    Schema::create('evaluation', function (Blueprint $table) {
        $table->id();
        $table->tinyInteger('note')->check('note >= 1 and note <= 5');
        $table->text('commentaire')->nullable();
        $table->dateTime('date')->useCurrent();  // Fix
        $table->unsignedBigInteger('objet_id');
        $table->unsignedBigInteger('evaluateur_id');
        $table->unsignedBigInteger('evalue_id');

        $table->foreign('objet_id')->references('id')->on('objet');
        $table->foreign('evaluateur_id')->references('id')->on('utilisateur');
        $table->foreign('evalue_id')->references('id')->on('utilisateur');
    });

    Schema::create('notification', function (Blueprint $table) {
        $table->id();
        $table->text('contenu');
        $table->text('contenu_email')->nullable();
        $table->boolean('envoyee')->default(false);
        $table->boolean('lue')->default(false);
        $table->dateTime('date_creation')->useCurrent();  // Fix
        $table->unsignedBigInteger('utilisateur_id');
        $table->unsignedBigInteger('annonce_id')->nullable();
        $table->unsignedBigInteger('reservation_id')->nullable();

        $table->foreign('utilisateur_id')->references('id')->on('utilisateur');
        $table->foreign('annonce_id')->references('id')->on('annonce');
        $table->foreign('reservation_id')->references('id')->on('reservation');
    });

    Schema::create('reclamation', function (Blueprint $table) {
        $table->id();
        $table->text('contenu');
        $table->enum('statut', ['nouvelle', 'en cours', 'resolue', 'rejetee'])->default('nouvelle');
        $table->dateTime('date_creation')->useCurrent();  // Fix
        $table->unsignedBigInteger('utilisateur_id');
        $table->unsignedBigInteger('reservation_id')->nullable();

        $table->foreign('utilisateur_id')->references('id')->on('utilisateur');
        $table->foreign('reservation_id')->references('id')->on('reservation');
    });
}

};
