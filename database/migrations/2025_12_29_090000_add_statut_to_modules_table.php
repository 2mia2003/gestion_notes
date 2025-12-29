<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('modules', function (Blueprint $table) {
            $table->string('statut', 20)->default('en_attente')->after('nom');
            $table->index('statut');
        });
    }

    public function down(): void
    {
        Schema::table('modules', function (Blueprint $table) {
            $table->dropIndex(['statut']);
            $table->dropColumn('statut');
        });
    }
};
