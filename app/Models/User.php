<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }

    public function endereco()
    {
        return $this->hasMany(Endereco::class);
    }
}
