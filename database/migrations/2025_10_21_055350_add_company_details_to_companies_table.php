<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('companies', function (Blueprint $table) {
        $table->string('address')->nullable();
        $table->string('tax_number')->nullable();
        $table->string('phone')->nullable();
        // bármi más mező, amit kötelezővé akarsz tenni
    });
}

public function down()
{
    Schema::table('companies', function (Blueprint $table) {
        $table->dropColumn(['address', 'tax_number', 'phone']);
    });
}
};
