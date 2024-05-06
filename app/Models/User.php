<?php

namespace App\Models;

use App\Models\category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as BasicAuthenticatable;

class user extends Model implements Authenticatable
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
        return $this->hasMany(category::class);
    }
}
