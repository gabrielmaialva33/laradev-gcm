<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

/**
 * @method static pluck(string $string)
 */
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
