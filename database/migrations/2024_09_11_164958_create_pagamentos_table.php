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
        Schema::create('pagamentos', function (Blueprint $table) {
            $table->id();
            $table->date('dataPagamento');
            $table->unsignedBigInteger('venda_id')->nullable(); // Definir venda_id como nullable, se necessário
            $table->foreign('venda_id')->references('id')->on('vendas'); // Relaciona corretamente à tabela vendas
            $table->unsignedBigInteger('formaDePagamento_id')->nullable();
            $table->foreign('formaDePagamento_id')->references('id')->on('forma_de_pagamentos')->onDelete('set null');
            $table->decimal('valor', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagamentos');
    }
};
