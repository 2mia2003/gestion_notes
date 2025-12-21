<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('document_note_id')->constrained('documents_notes')->cascadeOnDelete();
            $table->foreignId('etudiant_id')->constrained('etudiants')->restrictOnDelete();
            $table->foreignId('module_id')->constrained('modules')->restrictOnDelete();

            $table->decimal('valeur', 5, 2)->nullable(); // ex 14.50
            $table->string('type', 30)->default('EXAM'); // EXAM, CC, TP...
            $table->string('session', 30)->default('NORMALE'); // NORMALE, RATTRAPAGE...

            $table->timestamps();

            // Un étudiant ne doit pas avoir 2 notes identiques pour même doc+module+type+session
            $table->unique(['document_note_id', 'etudiant_id', 'module_id', 'type', 'session'], 'notes_unique_key');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
