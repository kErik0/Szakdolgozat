<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('companies', function (Blueprint $table) {
        $table->string('role')->default('company');  // alapértelmezett szerepkör
        $table->string('password');                  // jelszó
        $table->string('logo')->nullable();          // céglogó, opcionális
    });
}

public function down(): void
{
    Schema::table('companies', function (Blueprint $table) {
        $table->dropColumn(['role', 'password', 'logo']);
    });
}
};
