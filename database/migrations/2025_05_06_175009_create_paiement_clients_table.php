<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('paiements_clients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')->constrained()->onDelete('cascade');
            $table->foreignId('client_id')->constrained('utilisateurs')->onDelete('cascade');
            $table->decimal('montant', 8, 2);
            $table->string('methode'); // e.g. carte, paypal
            $table->timestamp('date_paiement');
            $table->enum('etat', ['effectué', 'annulé', 'en_attente'])->default('effectué');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paiements_clients');
    }
};
