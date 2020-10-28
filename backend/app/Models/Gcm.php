<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class Gcm extends Model
{
    use HasFactory;

    protected $fillable = [
        'matricula_gcm',
        'nome_guerra',
        'dados_pessoais_id',
        'endereco_id',
        'atribuicao',
        'historico',
        'status',
    ];

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
