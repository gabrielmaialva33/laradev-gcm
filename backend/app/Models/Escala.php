<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class Escala extends Model
{
    use HasFactory;

    protected $fillable = ['data_inicio', 'data_fim', 'observacao'];

    protected $casts = [
        'data_inicio' => 'datetime',
        'data_fim' => 'datetime',
        'observacao' => 'text',
    ];
}
