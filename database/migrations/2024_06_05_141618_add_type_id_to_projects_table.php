<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Aggiunge la colonna 'type_id' a 'projects' e definisce la chiave esterna
        Schema::table('projects', function (Blueprint $table) {
            $table->foreignId('type_id')->nullable()->constrained('types')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Rimuovere la colonna 'type_id' da 'projects' in caso di rollback
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign(['type_id']);
            $table->dropColumn('type_id');
        });
    }
};
