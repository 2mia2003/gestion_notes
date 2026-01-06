 <?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->id();

            // 🔗 Lien vers la filière
            $table->foreignId('filiere_id')
                ->nullable()
                ->constrained('filieres')
                ->nullOnDelete();

            // 🔗 Lien vers le niveau
            $table->foreignId('niveau_id')
                ->constrained('niveaux')
                ->cascadeOnDelete();


            // Infos module
            $table->string('code', 30);
            $table->string('nom', 200);

            // 👤 Enseignant responsable (user)
            $table->foreignId('responsable_user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->unsignedTinyInteger('credits')->default(0);

            $table->timestamps();

            // 🔐 Unicité logique
            $table->unique(['niveau_id', 'code']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};
