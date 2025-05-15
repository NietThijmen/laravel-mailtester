<?php

namespace App\Livewire\Dashboard\Widgets;

use App\Models\Email;
use App\Models\MailAccount;
use Livewire\Attributes\Lazy;
use Livewire\Component;

#[Lazy]
class EmailsSent extends Component
{

    public $emailsSentPerMailbox = [];

    public function mount()
    {
        $accounts = MailAccount::all(['id', 'username']);

        $mails_per_account = [];

        for($i = 0; $i < 10; $i++) {
            $mails_per_account[] = [
                'count' => 0,
                'account' => 'No account',
            ];
        }

        foreach ($accounts as $account) {
            $mails_per_account[] = [
                'count' => Email::where('mail_account_id', $account->id)->count('id'),
                'account' => $account->username,
            ];
        };

        usort($mails_per_account, function ($a, $b) {
            return $b['count'] <=> $a['count'];
        });

        $this->emailsSentPerMailbox = $mails_per_account;
    }

    public function render()
    {
        return view('livewire.dashboard.widgets.emails-sent');
    }
}
