<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $name
 * @property float $price
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property Client[] $clients
 */
class Plan extends Model
{
    const FREE = 1;

    /**
     * @var array
     */
    protected $fillable = ['name', 'price'];
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    public static $rules = [
        "name" => "required|max:150",
        "price" => "required|numeric"
    ];

    /**
     * @return BelongsToMany
     */
    public function clients(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Client');
    }
}
