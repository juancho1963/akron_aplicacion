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

            $table-> integer('descuentoCupon')->nullable()->after('fechaPedido');
            $table-> string('nameCupon')->nullable()->after('fechaPedido');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pedids', function (Blueprint $table) {

            $table->dropColumn('descuentoCupon');
            $table->dropColumn('nameCupon');
        });
    }
};
