<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->foreignId('company_id')->nullable()->constrained()->onDelete('cascade')->after('id');
            $table->string('title')->after('company_id');
            $table->text('description')->after('title');
            $table->string('location')->after('description');
            $table->decimal('salary', 10, 2)->nullable()->after('location');
            $table->enum('type', ['full-time','part-time','intern','remote'])->after('salary');
        });
    }

    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn(['company_id','title','description','location','salary','type']);
        });
    }
};