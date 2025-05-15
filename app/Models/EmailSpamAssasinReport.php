<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmailSpamAssasinReport extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'description',
        'email_spamassasin_id',
        'points',
    ];

    public function emailSpamassasin(): BelongsTo
    {
        return $this->belongsTo(EmailSpamassasin::class);
    }
}
