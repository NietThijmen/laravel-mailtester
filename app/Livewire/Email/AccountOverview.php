<?php

namespace App\Livewire\Email;

use App\Models\MailAccount;
use Illuminate\Support\Collection;
use Livewire\Attributes\Url;
use Livewire\Component;

class AccountOverview extends Component
{
    public MailAccount $account;

    #[Url('page')]
    public int $page = 0;
    public int $perPage = 10;
    public int $pages =0; // total number of pages

    public Collection $emails;


    public function mount(MailAccount $account)
    {
        $this->account = $account;
        $this->pages = ceil($account->emails->count() / $this->perPage);

        if ($this->page > $this->pages) {
            $this->page = $this->pages;
        }

        $this->emails = $this->getMailsForPage();
    }

    private function getMailsForPage()
    {
        $offset = $this->page * $this->perPage;
        return $this->account->emails()->skip($offset)->take($this->perPage)->get();
    }

    public function updated($propertyName)
    {

        if($propertyName === "page") {
            $this->emails = $this->getMailsForPage();
        }
    }

    public function render()
    {
        return view('livewire.email.account-overview');
    }
}
