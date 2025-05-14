<?php

namespace App\Livewire\Email;

use App\Models\Email;
use Livewire\Component;

class Detail extends Component
{
    public Email $email;
    public $has_attachments = false;

    public function mount(Email $email)
    {
        $this->email = $email;

        if ($this->email->hasMedia('attachments')) {
            $this->has_attachments = true;
        }
    }

    public function render()
    {
        return view('livewire.email.detail');
    }
}
