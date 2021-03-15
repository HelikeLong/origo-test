<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $state
 * @property string $city
 * @property string $birthday
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property Plan[] $plans
 */
class Client extends Model
{
    const STATES_FREE = ['são paulo', 'sao paulo', 'sp'];

    /**
     * @var array
     */
    protected $fillable = ['name', 'email', 'phone', 'state', 'city', 'birthday'];
    protected $dates = ['birthday', 'deleted_at', 'created_at', 'updated_at'];

    public static $rules = [
        "name" => "required|max:150",
        "email" => "required|email|max:100",
        "phone" => "required|regex:/^(\(?\d{2}\)?\s)?(\d{4,5}\-\d{4})$/i|max:15",
        "state" => "required|max:50",
        "city" => "required|max:100",
        "birthday" => "required|date"
    ];

    /**
     * @return BelongsToMany
     */
    public function plans(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Plan');
    }
}
