<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Email extends Model
{
    use SoftDeletes;

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
}
