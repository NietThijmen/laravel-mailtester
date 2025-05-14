<?php

namespace App\Console\Commands;

use App\Mailserver\SMTP\SmtpServer;
use App\Mailserver\SMTP\SmtpSubscriber;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class MailServer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:server {--port=25}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Launch a new mail server instance';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $dispatcher = new \Symfony\Component\EventDispatcher\EventDispatcher();

            $logger = Log::getLogger();
            $dispatcher->addSubscriber(new SmtpSubscriber($this));

            $loop = \React\EventLoop\Factory::create();
            $server = new SmtpServer($loop, $dispatcher);
            // Enable 3 authentication methods.
            $server->authMethods = [
                \Smalot\Smtp\Server\Connection::AUTH_METHOD_LOGIN,
                \Smalot\Smtp\Server\Connection::AUTH_METHOD_PLAIN,
                \Smalot\Smtp\Server\Connection::AUTH_METHOD_CRAM_MD5,
            ];

            $this->info("Starting mail server on port {$this->option('port')}...");
            $this->info("Press Ctrl+C to stop the server.");
            $server->listen($this->option('port'));
            $loop->run();
        }
        catch(\Exception $e) {
            dd($e);
        }
    }
}
