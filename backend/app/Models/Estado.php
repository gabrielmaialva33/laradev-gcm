<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;

    protected $fillable = ["codigo_ibge", "uf", "sigla", "gentilico"];
}
