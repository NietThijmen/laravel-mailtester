<?php

namespace App\Livewire\Dashboard\Widgets;

use App\Models\Email;
use Illuminate\Support\Collection;
use Livewire\Attributes\Lazy;
use Livewire\Component;

#[Lazy]
class Inbox extends Component
{
    public Collection $emails;

    public function mount()
    {
        $this->emails = Email::orderBy('created_at', 'desc')->limit(10)->get(['id', 'from', 'to', 'header', 'created_at']);
    }

    public function render()
    {
        return view('livewire.dashboard.widgets.inbox');
    }
}
