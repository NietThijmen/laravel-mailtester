<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MailAccount extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'username',
        'password',
    ];

    public function emails()
    {
        return $this->hasMany(Email::class, 'mail_account_id');
    }
}
