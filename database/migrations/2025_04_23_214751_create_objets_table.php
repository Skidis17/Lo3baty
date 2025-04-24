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
        Schema::create('objets', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 100);
            $table->text('description')->nullable();
            $table->string('ville', 50);
            $table->decimal('prix_journalier', 10, 2);
            $table->enum('etat', ['neuf', 'bon etat', 'usage', 'a reparer']);
            $table->foreignId('categorie_id')->constrained();
            $table->foreignId('proprietaire_id')->constrained('utilisateurs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('objets');
    }
};
