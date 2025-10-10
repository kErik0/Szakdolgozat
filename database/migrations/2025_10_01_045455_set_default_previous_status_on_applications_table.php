<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    DB::table('applications')->whereNull('previous_status')->update(['previous_status' => 'pending']);
    Schema::table('applications', function (Blueprint $table) {
        $table->enum('previous_status', ['pending','accepted','rejected'])
              ->default('pending')
              ->nullable(false)
              ->change();
    });
}

    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->enum('previous_status', ['pending','accepted','rejected'])
                  ->nullable()
                  ->change();
        });
    }
};