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
        Schema::create('vendas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id')->nullable();
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->unsignedBigInteger('formaDePagamento_id')->nullable();
            $table->foreign('formaDePagamento_id')->references('id')->on('forma_de_pagamentos');
            $table->dateTime('dataDoPagamento');
            $table->unsignedBigInteger('vendedor_id')->nullable();
            $table->foreign('vendedor_id')->references('id')->on('vendedores');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendas');
    }
};
