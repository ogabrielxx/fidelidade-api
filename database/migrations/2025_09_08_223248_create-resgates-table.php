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
        Schema::create("resgates", function (Blueprint $table) {
            $table->id();
            $table->dateTime('data');
            $table->foreignId('cliente')->constrained('clientes')->onDelete('cascade');
            $table->foreignId('premio')->constrained('premios')->onDelete('cascade');
            $table->integer('valor_pontos')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resgates');
    }
};
