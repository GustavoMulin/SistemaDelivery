<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurante extends Model
{
    /** @use HasFactory<\Database\Factories\RestauranteFactory> */
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
        'endereco',
    ];

    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
}
