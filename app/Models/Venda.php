<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    protected $table = 'vendas';

    protected $fillable = [
        'cliente_id',
        'vendedor_id',
        'formaDePagamento_id'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function formaDePagamento()
    {
        return $this->belongsTo(FormaDePagamento::class, 'formaDePagamento_id');
    }

}
