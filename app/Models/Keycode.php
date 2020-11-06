<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

/**
 * @method static where(string $column, string $value)
 * @method static create(array $array)
 */
class Keycode extends Model
{
    use HasFactory;

    protected $fillable = ['keycode', 'gcm_id'];

    protected $casts = [
        'active' => 'boolean',
    ];

    public static function getKeycodeId(string $column, string $value)
    {
        try {
            return Keycode::where($column, $value)->first()->id;
        } catch (\Exception $error) {
            return null;
        }
    }

    // -> relation one to one
    public function gcm()
    {
        return $this->hasOne(Gcm::class);
    }
}
