<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;

    protected $fillable = [
        'logradouro',
        'numero',
        'complemento',
        'cep',
        'codigo_endereco',
        'bairro_id',
    ];

    // -> relation has many
    public function bairro()
    {
        return $this->hasMany(Bairro::class);
    }
}
