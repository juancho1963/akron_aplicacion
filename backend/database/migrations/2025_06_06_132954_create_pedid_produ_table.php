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
        Schema::create('pedid_produ', function (Blueprint $table) {
            $table->id();

            $table->decimal('precio_prod',10,2);
            $table->integer('cantidad_prod');
            $table->foreignId('pedid_id')->constrained()->cascadeOnDelete();
            $table->foreignId('produ_id')->constrained()->cascadeOnDelete();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedid_produ');
    }
};
