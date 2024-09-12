<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('parcelas', function (Blueprint $table) {
        $table->id();
        $table->foreignId('venda_id')->constrained()->onDelete('cascade');
        $table->decimal('valor', 10, 2);
        $table->date('data_vencimento');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('parcelas');
}

};
