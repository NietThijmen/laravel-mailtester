<?php

namespace App\Http\Requests;

class SpamAssasin
{
    public static function getDetails(
        string $rawMail
    ): array
    {
        $data = \Http::post("https://spamcheck.postmarkapp.com/filter", [
            'email' => $rawMail,
            'options' => 'long'
        ])->json();

        return $data;
    }
}
