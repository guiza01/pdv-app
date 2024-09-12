<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemVenda extends Model
{
    use HasFactory;

    protected $table = 'item_venda';
    protected $fillable = [
        'venda_id',
        'produto_id',
        'quantidade',
        'precoUnitario',
        'subTotal',
    ];

    public function venda()
    {
        return $this->hasMany(Venda::class);
    }

    public function produto()
    {
        return $this->hasMany(Produto::class);
    }

}
