<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;

    protected $fillable = ['codigo_ibge', 'municipio', 'gentilico', 'estado_id'];

    // -> relation has one
    public function estado()
    {
        return $this->hasOne(Estado::class);
    }
}
