<?php

namespace App\Livewire\Pulse;

use Laravel\Pulse\Livewire\Card;
use Livewire\Attributes\Lazy;
use Livewire\Component;

#[Lazy]
class EmailsReceived extends Card
{
    public function render()
    {

        return view('livewire.pulse.emails-received', [
            'emails' => $this->aggregate('emails-received', ['sum', 'count'])
        ]);
    }
}
