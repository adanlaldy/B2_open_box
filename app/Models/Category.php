<?php

namespace App\Models;

use App\Models\user;
use App\Models\email;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'native',
    ];

    public function user()
    {
        return $this->belongsTo(user::class);
    }

    public function emails()
    {
        return $this->hasMany(email::class);
    }
}
