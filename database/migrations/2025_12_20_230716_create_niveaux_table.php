<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('niveaux', function (Blueprint $table) {
            $table->id();
            $table->foreignId('filiere_id')->constrained('filieres')->cascadeOnDelete();

            $table->string('code', 20);   // ex: L1, L2, L3, M1...
            $table->string('nom', 150);   // ex: Licence 1
            $table->timestamps();

            $table->unique(['filiere_id', 'code']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('niveaux');
    }
};
