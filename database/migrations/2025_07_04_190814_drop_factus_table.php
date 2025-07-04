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
        Schema::dropIfExists('factus');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('factus', function (Blueprint $table) {
            $table->id();

            $table->string('numFactura');
            $table->dateTime('fechaFactura');
            $table->string('nameUser');
            $table->string('docIdenUser');
            $table->string('direcUser');
            $table->string('numTelefoUser');

            $table->timestamps();
        });
    }
};
