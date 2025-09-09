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
        Schema::table('pedids', function (Blueprint $table) {
             $table->foreign('cupon_id')
                      ->references('id')
                      ->on('cupons')
                      ->constrained()
                      ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pedids', function (Blueprint $table) {
            //
        });
    }
};
