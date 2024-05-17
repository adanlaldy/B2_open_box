<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'category_id',
        'from_user_id',
        'to_user_id',
        'subject',
        'content',
        'sent_at',
        'starred',
        'attachment',
        'previous_category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function from()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }
    
    public function emailUsers()
    {
        return $this->hasMany(EmailUser::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }
}
