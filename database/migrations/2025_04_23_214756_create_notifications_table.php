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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->text('contenu');
            $table->text('contenu_email')->nullable();
            $table->boolean('envoyee')->default(false);
            $table->boolean('lue')->default(false);
            $table->foreignId('utilisateur_id')->constrained('utilisateurs');
            $table->foreignId('annonce_id')->nullable()->constrained();
            $table->foreignId('reservation_id')->nullable()->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
