<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('workflow_notes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('document_note_id')->constrained('documents_notes')->cascadeOnDelete();

            // acteur du workflow (validation/rejet)
            $table->foreignId('user_id')->constrained('users')->restrictOnDelete();

            $table->enum('action', ['SUBMIT', 'APPROVE', 'REJECT']);
            $table->text('commentaire')->nullable();

            $table->timestamps();

            $table->index(['document_note_id', 'action']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('workflow_notes');
    }
};
