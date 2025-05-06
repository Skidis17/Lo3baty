<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('paiements_clients', function (Blueprint $table) {
            // Pour modifier une colonne existante, tu dois utiliser doctrine/dbal
            $table->enum('methode', ['paypal', 'especes', 'cheque'])->change();
        });
    }

    public function down(): void
    {
        Schema::table('paiements_clients', function (Blueprint $table) {
            // Tu peux restaurer l'ancien type string si besoin
            $table->string('methode')->change();
        });
    }
};
