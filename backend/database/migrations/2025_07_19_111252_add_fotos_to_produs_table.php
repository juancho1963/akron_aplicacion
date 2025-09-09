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
        Schema::table('produs', function (Blueprint $table) {

            $table->string('foto2')->after('foto');
            $table->string('foto3')->after('foto');
            $table->string('foto4')->after('foto');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produs', function (Blueprint $table) {

            $table->string('foto2')->after('foto');
            $table->string('foto3')->after('foto');
            $table->string('foto4')->after('foto');

        });
    }
};
