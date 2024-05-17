<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable as BasicAuthenticatable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements Authenticatable
{
    use BasicAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'question_recuperation',
        'response_recuperation',
        'birthday',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'response_recuperation',
    ];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function emailUsers()
    {
        return $this->hasMany(EmailUser::class);
    }
}
