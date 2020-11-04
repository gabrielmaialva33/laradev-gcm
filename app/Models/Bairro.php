<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

/**
 * @method static where(string $column, string $value)
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

    public static function getBairroId(string $column, string $value)
    {
        try {
            return Bairro::where($column, $value)->first()->id;
        } catch (\Exception $error) {
            return null;
        }
    }

    // -> relation has one
    public function estado()
    {
        return $this->hasOne(Municipio::class);
    }
}
