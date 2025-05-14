<?php

namespace App\Mailserver\SMTP;

use App\Models\MailAccount;
use Illuminate\Support\Facades\Log;
use Smalot\Smtp\Server\Server;

class SmtpServer extends Server
{
    /**
     * @param  Connection  $connection
     * @param  MethodInterface  $method
     * @return bool
     */
    public function checkAuth(Connection|\Smalot\Smtp\Server\Connection $connection, MethodInterface|\Smalot\Smtp\Server\Auth\MethodInterface $method)
    {
        $username = $method->getUsername();
        $password = $this->getPasswordForUsername($username);

        Log::info("SMTP Auth check for user: $username");
        Log::info("SMTP Auth password: $password");

        return $method->validateIdentity($password);
    }

    /**
     * @return string
     */
    protected function getPasswordForUsername(?string $username = null)
    {
        $mailAccount = MailAccount::where('username', $username)->first();

        if (! $mailAccount) {
            Log::error("SMTP Auth failed for user: $username");

            return false;
        }

        $password = $mailAccount->password;

        return $password;
    }
}
