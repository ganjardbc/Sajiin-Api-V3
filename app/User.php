<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeGetUserWithEmail($query, $email)
    {
        return $this
        ->select(
            'users.id',
            'users.image',
            'users.name',
            'users.username',
            'users.email',
            'users.provider',
            'users.enabled',
            'users.status',
            'users.password',
            'users.owner_id',
            'users.role_id',
            'roles.role_id as main_role_id',
            'roles.role_name'
        )
        ->join('roles', 'roles.id', '=', 'users.role_id')
        ->where(['email'=> $email])
        ->first();
    }
}
