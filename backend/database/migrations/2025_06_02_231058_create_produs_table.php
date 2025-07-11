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
        Schema::create('produs', function (Blueprint $table) {
            $table->id();

            $table->string('indice');
            $table->string('referencia');
            $table->longText('descripcion');
            $table->integer('cantidad');
            $table->decimal('precio',10,2);
            $table->decimal('descuento',5,2);
            $table->string('foto');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produs');
    }
};
