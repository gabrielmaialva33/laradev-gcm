<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

/**
 * @method static where(string $column, string $value)
 * @method static create(array $array)
 */
class Gcm extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_guerra',
        'dados_pessoais_id',
        'endereco_id',
        'atribuicao',
        'historico',
        'status',
    ];

    public static function getGcmId(string $column, string $value)
    {
        try {
            return Gcm::where($column, $value)->first()->id;
        } catch (\Exception $error) {
            return null;
        }
    }

    public static function getDadosPessoaisId(string $column, string $value)
    {
        try {
            return Gcm::where($column, $value)->first()->id;
        } catch (\Exception $error) {
            return null;
        }
    }

    // -> relation has one
    public function dadosPessoais()
    {
        return $this->hasOne(DadosPessoais::class);
    }

    // -> relation has one
    public function endereco()
    {
        return $this->hasOne(Endereco::class);
    }
}
