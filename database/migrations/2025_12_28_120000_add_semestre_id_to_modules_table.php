<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('modules', function (Blueprint $table) {
            if (!Schema::hasColumn('modules', 'semestre_id')) {
                // Add semestre_id after niveau_id if not exists
                $table->foreignId('semestre_id')
                    ->after('niveau_id')
                    ->constrained('semestres')
                    ->cascadeOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('modules', function (Blueprint $table) {
            if (Schema::hasColumn('modules', 'semestre_id')) {
                // Drop FK and column
                $table->dropForeign(['semestre_id']);
                $table->dropColumn('semestre_id');
            }
        });
    }
};
