<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    /** @use HasFactory<\Database\Factories\ProdutoFactory> */
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
        'preco',
        'restaurante_id',
        'categoria_id',
        'imagem',
    ];

    public function restaurante()
    {
        return $this->belongsTo(Restaurante::class);
    }

    public function categoria()
    {
        return $this->belongsTo(CategoriaProduto::class, 'categoria_id');
    }

    public function pedidos()
    {
        return $this->hasMany(ItemPedido::class, 'produto_id');
    }
}
