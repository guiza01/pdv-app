<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('item_venda', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('venda_id')->nullable();
            $table->foreign('venda_id')->references('id')->on('vendas');
            $table->unsignedBigInteger('produto_id')->nullable();
            $table->foreign('produto_id')->references('id')->on('produtos');
            $table->integer('quantidade');
            $table->decimal('precoUnitario', 10, 2);
            $table->decimal('subTotal', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_venda');
    }
};
