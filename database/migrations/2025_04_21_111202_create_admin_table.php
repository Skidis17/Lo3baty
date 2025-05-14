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
    { Schema::create('admin', function (Blueprint $table) {
        $table->id(); // id auto-incrémenté
        $table->string('nom');
        $table->string('prenom');
        $table->string('email')->unique();
        $table->string('mot_pass');
        $table->timestamps(); // pour created_at et updated_at automatiquement
    });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};
