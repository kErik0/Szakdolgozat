<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            // MySQL esetén enum módosítása
            $table->enum('status', ['pending', 'accepted', 'rejected', 'archived'])->default('pending')->change();

            // Felesleges archived boolean mező törlése
            if (Schema::hasColumn('applications', 'archived')) {
                $table->dropColumn('archived');
            }
        });
    }

    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            // Visszaállítjuk az eredeti enumot
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending')->change();

            // Visszaadjuk az archived mezőt
            $table->boolean('archived')->default(false)->after('status');
        });
    }
};