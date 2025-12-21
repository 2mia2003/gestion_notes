<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('semestres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('annee_academique_id')->constrained('annees_academiques')->cascadeOnDelete();

            $table->string('code', 10); // S1, S2...
            $table->string('nom', 100); // Semestre 1...
            $table->date('date_debut')->nullable();
            $table->date('date_fin')->nullable();

            $table->timestamps();

            $table->unique(['annee_academique_id', 'code']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('semestres');
    }
};
