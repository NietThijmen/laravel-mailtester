<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Email extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;

    protected $fillable = [
        'from',
        'to',
        'header',
        'html',
        'text',
        'raw',

        'mail_account_id',
    ];

    public function account()
    {
        return $this->belongsTo(MailAccount::class, 'mail_account_id');
    }

    public function comments()
    {
        return $this->hasMany(EmailComment::class);
    }

    public function spamassasin()
    {
        return $this->hasOne(EmailSpamassasin::class);
    }
}
