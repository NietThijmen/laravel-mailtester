<?php

namespace App\Livewire\Email;

use App\Models\Email;
use Livewire\Component;

class Detail extends Component
{
    public Email $email;

    public function mount(Email $email)
    {
        $this->email = $email;
    }

    public function render()
    {
        return view('livewire.email.detail');
    }
}
