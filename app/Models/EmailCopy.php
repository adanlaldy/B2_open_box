<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class EmailCopy extends Pivot
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'email_id',
        'type', // 'CC' or 'BCC'
    ];

    /**
     * Get the email associated with the pivot.
     */
    public function email()
    {
        return $this->belongsTo(Email::class);
    }

    /**
     * Get the user associated with the pivot.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
