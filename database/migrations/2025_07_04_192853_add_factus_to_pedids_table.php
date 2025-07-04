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

            $table->string('numFactura')->after('user_id');
            $table->dateTime('fechaFactura')->after('user_id');
            $table->string('nameUser')->after('user_id');
            $table->string('docIdenUser')->after('user_id');
            $table->string('direcUser')->after('user_id');
            $table->string('numTelefoUser')->after('user_id');
            $table->string('statusped')->after('user_id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pedids', function (Blueprint $table) {

            $table->string('numFactura');
            $table->dateTime('fechaFactura');
            $table->string('nameUser');
            $table->string('docIdenUser');
            $table->string('direcUser');
            $table->string('numTelefoUser');

        });
    }
};
