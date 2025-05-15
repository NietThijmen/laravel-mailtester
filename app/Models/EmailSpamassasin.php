<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmailSpamassasin extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'score',
    ];

    public function email()
    {
        return $this->belongsTo(Email::class);
    }

    public function reports()
    {
        return $this->hasMany(EmailSpamAssasinReport::class);
    }
}
