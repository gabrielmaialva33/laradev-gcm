<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class EscalaGcm extends Model
{
    use HasFactory;

    protected $fillable = [
        'gcm_id',
        'escala_id',
        'data_inicio',
        'data_fim',
        'observacao',
    ];

    protected $casts = [
        'data_inicio' => 'datetime',
        'data_fim' => 'datetime',
        'observacao' => 'text',
    ];

    // -> relation has one
    public function gcm()
    {
        return $this->hasOne(Gcm::class);
    }

    // -> relation has one
    public function escala()
    {
        return $this->hasOne(Escala::class);
    }
}
