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
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('note')->unsigned()->check('note >= 1 and note <= 5');
            $table->text('commentaire')->nullable();
            $table->foreignId('objet_id')->constrained();
            $table->foreignId('evaluateur_id')->constrained('utilisateurs');
            $table->foreignId('evalue_id')->constrained('utilisateurs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};
