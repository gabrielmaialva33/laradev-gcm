<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

/**
 * @method static where(string $column, string $value)
 * @method static create(array $array)
 */
class DadosPessoais extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome',
        'rg',
        'cpf',
        'telefone',
        'nome_mae',
        'nome_pai',
        'data_nascimento',
        'municipio_nascimento_id',
        'sexo',
        'cutis',
        'tipo_sanguineo',
        'estado_civil',
        'profissao',
        'escolaridade',
        'nome_conjuge',
        'nome_filhos',
        'titulo_eleitor',
        'zona_eleitoral',
        'cnh',
        'tipo_cnh',
        'validade_cnh',
        'observacao',
    ];

    protected $casts = [
        'telefone' => 'array',
        'nome_filhos' => 'array',
    ];

    protected $hidden = ['municipio_nascimento_id', 'created_at', 'updated_at'];

    // -> get dados pessoais id

    public static function getDadosPessoaisId(string $column, string $value)
    {
        try {
            return DadosPessoais::where($column, $value)->first()->id;
        } catch (\Exception $error) {
            return null;
        }
    }

    // -> relation has one
    public function municipio_nascimento()
    {
        return $this->belongsTo(Municipio::class, 'municipio_nascimento_id');
    }
}
