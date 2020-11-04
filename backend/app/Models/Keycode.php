<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class Keycode extends Model
{
    use HasFactory;

    protected $fillable = ['keycode', 'gcm_id', 'active'];

    protected $casts = [
        'active' => 'boolean',
    ];

    // -> relation one to one
    public function gcm()
    {
        return $this->hasOne(Gcm::class);
    }
}
