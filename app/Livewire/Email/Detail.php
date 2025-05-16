<?php

namespace App\Livewire\Email;

use App\Models\Email;
use Illuminate\Mail\Attachment;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Detail extends Component
{
    public Email $email;

    public $has_attachments = false;

    public $has_spam = false;

    public $comment;

    public function mount(Email $email)
    {
        $this->email = $email;

        if ($this->email->hasMedia('attachments')) {
            $this->has_attachments = true;
        }

        if ($this->email->spamassasin) {
            $this->has_spam = true;
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

    public function forwardEmail(
        string $to
    )
    {
        $html_content = $this->email->html;
        $text_content = $this->email->text;
        $subject = $this->email->header;
        $from = $this->email->from;
        $to = $to ?: $this->email->to;


        $attachments = [];
        foreach ($this->email->getMedia('*') as $attachment) {
            $attachments[] = Attachment::fromPath($attachment->getPath())->as($attachment->file_name);
        }


        $mailable = (new Mailable())
            ->subject("Fwd: $subject")
            ->html($html_content)
            ->attachMany($attachments);

        Mail::to($to)->send($mailable);
    }

    public function deleteEmail()
    {
        $this->email->delete();
        $this->redirectRoute('account.overview', $this->email->account);
    }

    public function render()
    {
        return view('livewire.email.detail');
    }
}
