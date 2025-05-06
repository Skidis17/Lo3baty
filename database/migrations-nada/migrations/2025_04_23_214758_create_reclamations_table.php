<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reclamations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('utilisateurs')->cascadeOnDelete();
            $table->foreignId('objet_id')->nullable()->constrained('objets')->nullOnDelete();
            $table->foreignId('partenaire_id')->nullable()->constrained('utilisateurs')->nullOnDelete();
            $table->foreignId('reservation_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('sujet'); // Petit titre pour la réclamation
            $table->text('message'); // Message complet
            $table->enum('statut', ['en_attente', 'resolue', 'rejetee'])->default('en_attente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reclamations');
    }
};
