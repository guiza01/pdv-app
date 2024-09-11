<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    use HasFactory;

    protected $table = 'pagamentos';
    protected $fillable = [
        'dataPagamento',
        'venda_id',
        'formaDePagamento_id',
        'valor',
    ];

    public function venda()
    {
        return $this->belongsTo(Venda::class);
    }

    public function formaDePagamento()
    {
        return $this->belongsTo(FormaDePagamento::class, 'formaDePagamento_id');
    }

}
