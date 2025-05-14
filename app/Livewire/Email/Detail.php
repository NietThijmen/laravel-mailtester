<?php

namespace App\Livewire\Email;

use App\Models\Email;
use Livewire\Component;

class Detail extends Component
{
    public Email $email;
    public $has_attachments = false;

    public $comment;

    public function mount(Email $email)
    {
        $this->email = $email;

        if ($this->email->hasMedia('attachments')) {
            $this->has_attachments = true;
        }
    }

    public function addComment()
    {
        $user = auth()->user();

        if ($this->comment) {
            $this->email->comments()->create([
                'message' => $this->comment,
                'user_id' => $user->id,
                'email_id' => $this->email->id, // shouldn't be needed but just in case
            ]);
            $this->comment = '';
        }
    }

    public function render()
    {
        return view('livewire.email.detail');
    }
}
