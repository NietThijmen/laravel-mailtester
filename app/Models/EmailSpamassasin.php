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

    public function reports()
    {
        return $this->hasMany(EmailSpamAssasinReport::class);
    }
}
