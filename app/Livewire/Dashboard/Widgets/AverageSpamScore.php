<?php

namespace App\Livewire\Dashboard\Widgets;

use Livewire\Attributes\Lazy;
use Livewire\Component;

#[Lazy]
class AverageSpamScore extends Component
{

    public $spamPerMailbox = [];

    public function mount()
    {
        $accounts = \App\Models\MailAccount::all(['id', 'username']);

        $spam_per_account = [];

        for($i = 0; $i < 10; $i++) {
            $spam_per_account[] = [
                'count' => 0,
                'account' => 'No account',
            ];
        }

        foreach ($accounts as $account) {
            $spam_per_account[] = [
                'count' => \App\Models\EmailSpamassasin::where('mail_account_id', $account->id)->avg('score'),
                'account' => $account->username,
            ];
        };

        usort($spam_per_account, function ($a, $b) {
            return $b['count'] <=> $a['count'];
        });

        $this->spamPerMailbox = $spam_per_account;

    }

    public function render()
    {
        return view('livewire.dashboard.widgets.average-spam-score');
    }
}
