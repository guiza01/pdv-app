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
        'formaDePagamento_id',
        'dataDoPagamento',
    ];

    public function itens()
    {
        return $this->hasMany(ItemVenda::class);
    }

    public function parcelas()
    {
        return $this->hasMany(Parcela::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function formaDePagamento()
    {
        return $this->belongsTo(FormaDePagamento::class, 'formaDePagamento_id');
    }
}
