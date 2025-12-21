<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('documents_notes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('module_id')->constrained('modules')->restrictOnDelete();
            $table->foreignId('semestre_id')->constrained('semestres')->restrictOnDelete();

            // uploader
            $table->foreignId('user_id')->constrained('users')->restrictOnDelete();

            $table->string('titre', 200);
            $table->string('fichier_path', 500); // stockage (storage/app/..)
            $table->string('original_name', 255)->nullable();

            $table->enum('statut', ['DRAFT', 'SUBMITTED', 'APPROVED', 'REJECTED'])->default('DRAFT');

            $table->timestamp('submitted_at')->nullable();
            $table->timestamp('approved_at')->nullable();

            $table->timestamps();

            $table->index(['module_id', 'semestre_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents_notes');
    }
};
