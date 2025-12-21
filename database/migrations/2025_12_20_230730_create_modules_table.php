<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('niveau_id')->constrained('niveaux')->cascadeOnDelete();

            $table->string('code', 30);
            $table->string('nom', 200);

            // enseignant responsable (optionnel) : user_id
            $table->foreignId('responsable_user_id')->nullable()->constrained('users')->nullOnDelete();

            $table->unsignedTinyInteger('credits')->default(0);

            $table->timestamps();

            $table->unique(['niveau_id', 'code']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};
