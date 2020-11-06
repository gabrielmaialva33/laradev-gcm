<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

/**
 * @method static where(string $column, string $value)
 * @method static pluck(string $string)
 * @method static create(array $array)
 */
class Bairro extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome',
        'codigo_bairro',
        'observacao',
        'municipio_id',
    ];

    // -> get bairro id
    public static function getBairroId(string $column, string $value)
    {
        try {
            return Bairro::where($column, $value)->first()->id;
        } catch (\Exception $error) {
            return null;
        }
    }

    // -> get bairro by bairro code
    public static function getBairroByCode(string $column, string $value)
    {
        try {
            return Bairro::where($column, $value)->first();
        } catch (\Exception $error) {
            return null;
        }
    }

    // -> relation has one
    public function municipio()
    {
        return $this->hasOne(Municipio::class);
    }
}
