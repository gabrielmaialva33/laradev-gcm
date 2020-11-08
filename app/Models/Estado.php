<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

/**
 * @method static where(string $column, string $value)
 */
class Estado extends Model
{
    use HasFactory;

    protected $fillable = ["codigo_ibge", "uf", "sigla", "gentilico"];

    protected $hidden = ['created_at', 'updated_at'];

    public static function getEstadoId(string $column, string $value)
    {
        return Estado::where($column, $value)->first()->id;
    }
}
