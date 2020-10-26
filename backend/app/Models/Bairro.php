<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class Bairro extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'codigo_bairro',
        'observacao',
        'municipio_id',
    ];

    // -> relation has one
    public function estado()
    {
        return $this->hasOne(Municipio::class);
    }
}
