<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

/**
 * @method static where(string $column, string $value)
 */
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

    public static function getEnderecoId(string $column, string $value)
    {
        try {
            return Endereco::where($column, $value)->first()->id;
        } catch (\Exception $err) {
            return $err;
        }
    }

    // -> relation has many
    public function bairro()
    {
        return $this->hasMany(Bairro::class);
    }
}
