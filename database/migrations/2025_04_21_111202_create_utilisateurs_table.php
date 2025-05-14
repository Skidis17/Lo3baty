<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('utilisateurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('surnom')->unique();
            $table->string('email')->unique();
            $table->string('mot_de_passe');
            $table->enum('role', ['client', 'partenaire'])->default('client');
            $table->boolean('is_active')->default(true);
            $table->string('image_profil')->nullable();
            $table->string('cin_recto')->nullable();
            $table->string('cin_verso')->nullable();
            // Retirez la ligne rememberToken()
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('utilisateurs');
    }
};