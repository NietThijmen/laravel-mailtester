<?php

namespace App\Livewire\Email;

use App\Models\MailAccount;
use Flux\Flux;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateAccount extends Component
{
    #[Validate('required|email|min:3|max:255')]
    public string $username;
    #[Validate('required|min:8|max:255')]
    public string $password;


    public function save(): void
    {
        $this->validate();

        MailAccount::create([
            'username' => $this->username,
            'password' => $this->password,
        ]);

        $this->reset();
        $this->dispatch('saved-account');
    }

    public function render()
    {
        return view('livewire.email.create-account');
    }
}
