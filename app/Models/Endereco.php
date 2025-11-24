<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    /** @use HasFactory<\Database\Factories\EnderecoFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'rua',
        'numero',
        'bairro',
        'cidade',
        'estado',
        'cep',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'endereco_id');
    }
}
