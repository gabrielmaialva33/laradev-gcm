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

    protected $casts = [
        'status' => 'boolean',
    ];

    // -> get gcm id
    public static function getGcmId(string $column, string $value)
    {
        try {
            return Gcm::where($column, $value)->first()->id;
        } catch (\Exception $error) {
            return null;
        }
    }

    // -> relation has one
    public function dados_pessoais()
    {
        return $this->belongsTo(DadosPessoais::class, 'dados_pessoais_id');
    }

    // -> relation has one
    public function endereco()
    {
        return $this->belongsTo(Endereco::class, 'endereco_id');
    }
}
