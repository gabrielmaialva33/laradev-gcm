<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class DadosPessoais extends Model
{
    use HasFactory;

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

    // -> relation has one
    public function municipio()
    {
        return $this->hasOne(Municipio::class);
    }
}
