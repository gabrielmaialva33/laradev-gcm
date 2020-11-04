<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

/**
 * @method static where(string $column, string $value)
 */
class Municipio extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo_ibge',
        'municipio',
        'gentilico',
        'estado_id',
    ];

    // -> get municipio id
    public static function getMunicipioId(string $column, string $value)
    {
        try {
            return Municipio::where($column, $value)->firstOrFail()->id;
        } catch (\Exception $error) {
            return null;
        }
    }

    // -> relation has one
    public function estado()
    {
        return $this->hasOne(Estado::class);
    }
}
