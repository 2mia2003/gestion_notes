<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('etudiants', function (Blueprint $table) {
            $table->id();

            $table->string('matricule', 30)->unique();
            $table->string('prenom', 100);
            $table->string('nom', 100);
            $table->date('date_naissance')->nullable();
            $table->enum('sexe', ['M', 'F'])->nullable();

            $table->foreignId('filiere_id')->constrained('filieres')->restrictOnDelete();
            $table->foreignId('niveau_id')->constrained('niveaux')->restrictOnDelete();

            $table->timestamps();

            $table->index(['filiere_id', 'niveau_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('etudiants');
    }
};
