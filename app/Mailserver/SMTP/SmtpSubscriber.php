<?php

namespace App\Mailserver\SMTP;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Smalot\Smtp\Server\Event\MessageReceivedEvent;
use Smalot\Smtp\Server\Event\MessageSentEvent;
use Smalot\Smtp\Server\Events;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class SmtpSubscriber implements EventSubscriberInterface
{
    public $logger;

    public function __construct(
        public Command $command
    ) {
        $this->logger = Log::channel('smtp');
    }

    public static function getSubscribedEvents()
    {
        return [
            //            Events::CONNECTION_CHANGE_STATE => 'onConnectionChangeState',
            //            Events::CONNECTION_HELO_RECEIVED => 'onConnectionHeloReceived',
            //            Events::CONNECTION_AUTH_ACCEPTED => 'onConnectionAuthAccepted',
            //            Events::CONNECTION_AUTH_REFUSED => 'onConnectionAuthRefused',
            //            Events::CONNECTION_FROM_RECEIVED => 'onConnectionFromReceived',
            //            Events::CONNECTION_RCPT_RECEIVED => 'onConnectionRcptReceived',
            //            Events::CONNECTION_LINE_RECEIVED => 'onConnectionLineReceived',
            Events::MESSAGE_RECEIVED => 'onMessageReceived',
            Events::MESSAGE_SENT => 'onMessageSent',
        ];
    }

    public function onMessageSent(MessageSentEvent $event)
    {
        dd($event);
    }

    public function onMessageReceived(MessageReceivedEvent $event)
    {
        $this->command->info('Email received');
        $this->logger->info('New message received');

        $username = $event->getConnection()->getAuthMethod()->getUsername();
        $mail_account = \App\Models\MailAccount::where('username', $username)->first();

        if (! $mail_account) {
            $this->logger->error('Mail account not found for username: '.$username);
            $this->command->error('Mail account not found for username: '.$username);
            $event->getConnection()->reject();

            return;
        }

        // parse the email
        $parser = new \PhpMimeMailParser\Parser;

        $parser->setText($event->getMessage());

        $from = $parser->getHeader('from');
        $to = $parser->getHeader('to');
        $subject = $parser->getHeader('subject');

        $email = new \App\Models\Email;
        $email->from = $from;
        $email->to = $to;
        $email->header = $subject;
        $email->html = $parser->getMessageBody('html');
        $email->text = $parser->getMessageBody('text');
        $email->raw = $event->getMessage();
        $email->mail_account_id = $mail_account->id; // TODO: get the mail account id from the event
        $email->save();
        $this->logger->info('Email saved to database');

        //        $this->logger->info("Message: " . $event->getMessage());
    }
}
