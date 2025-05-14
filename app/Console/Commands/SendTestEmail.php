<?php

namespace App\Console\Commands;

use App\Mail\TestMail;
use App\Models\Email;
use App\Models\MailAccount;
use Illuminate\Console\Command;
use Illuminate\Mail\Mailable;

class SendTestEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:test {--port=2025}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a test email to check if the mail server is working';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $this->info("Sending test mail to localhost:{$this->option('port')}...");

        // check if mail account is created
        $account = MailAccount::first();
        if(!$account) {
            $this->info("Creating test mail account...");
            $account = new MailAccount();
            $account->username = "test@example.com";
            $account->password = "password";
            $account->save();
        }

        $mail_count = Email::count();



        // set the config values to the test values
        config(['mail.default' => 'smtp']);
        config(['mail.mailers.smtp.transport' => 'smtp']);
        config(['mail.mailers.smtp.host' => 'localhost']);
        config(['mail.mailers.smtp.port' => $this->option('port')]);
        config(['mail.mailers.smtp.encryption' => null]);
        config(['mail.mailers.smtp.username' => $account->username]);
        config(['mail.mailers.smtp.password' => $account->password]);
        config(['mail.from.address' => $account->username]);
        config(['mail.from.name' => 'Test Mail']);

        \Mail::to('test@test.com')
            ->send(new TestMail());

        // check if the email was sent
        $new_mail_count = Email::count();

        if($new_mail_count === $mail_count) {
            $this->error('Email not sent');
        } else {
            $this->info('Email sent successfully');
        }


    }
}
