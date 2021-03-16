<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @property integer $id
 * @property string $user
 * @property string $password
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 */
class User extends Model implements Authenticatable, JWTSubject
{
    use AuthenticableTrait, Authorizable;
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['user', 'password', 'deleted_at', 'created_at', 'updated_at'];
    protected $hidden = ['password'];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
