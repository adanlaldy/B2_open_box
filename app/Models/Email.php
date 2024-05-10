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
        'category_id',
        'from_user_id',
        'to_user_id',
        'cc_user_id',
        'bcc_user_id',
        'subject',
        'content',
        'sent_at',
        'starred',
        'attachment',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function from()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    public function to()
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }

    public function cc()
    {
        return $this->belongsTo(User::class, 'cc_user_id');
    }

    public function bcc()
    {
        return $this->belongsTo(User::class, 'bcc_user_id');
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }
}
