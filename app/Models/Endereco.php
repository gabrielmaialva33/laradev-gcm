<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

/**
 * @method static where(string $column, string $value)
 * @method static create(array $array)
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

    protected $hidden = ['bairro_id', 'created_at', 'updated_at'];

    public static function getEnderecoId(string $column, string $value)
    {
        try {
            return Endereco::where($column, $value)->first()->id;
        } catch (\Exception $error) {
            return null;
        }
    }

    // -> relation has many
    public function bairro()
    {
        return $this->belongsTo(Bairro::class, 'bairro_id');
    }
}
