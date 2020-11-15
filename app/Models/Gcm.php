<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * @method static where(string $column, string $value)
 * @method static create(array $array)
 * @method static find($id)
 */
class Gcm extends Model
{
    protected $fillable = [
        'nome_guerra',
        'dados_pessoais_id',
        'endereco_id',
        'atribuicao',
        'historico',
        'status',
    ];

    use HasFactory;

    protected $casts = [
        'status' => 'boolean',
    ];
    protected $hidden = [
        'dados_pessoais_id',
        'endereco_id',
        'created_at',
        'updated_at',
    ];

    // -> return gcm id
    public static function getGcmId(string $column, string $value)
    {
        try {
            return Gcm::where($column, $value)->first()->id;
        } catch (\Exception $error) {
            return null;
        }
    }

    // -> return all data to gcm

    public static function getDataGcm(string $id)
    {
        try {
            return Gcm::with([
                'dados_pessoais',
                'endereco',
                'endereco.bairro',
                'endereco.bairro.municipio',
                'endereco.bairro.municipio.estado',
                'dados_pessoais.municipio_nascimento',
                'dados_pessoais.municipio_nascimento.estado',
            ])->find($id);
        } catch (HttpException $e) {
            return response()->json(['Erro no servidor'], $e->getStatusCode());
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
