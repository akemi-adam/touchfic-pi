<?php

namespace App\Mail;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\{
    Content, Envelope, Address
};
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\User;

class NewCommentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;

    public string $content;

    public User $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, string $content, User $user)
    {
        $this->subject = $subject;
        
        $this->content = $content;

        $this->user = $user;
    }

    public function envelope()
    {
        return new Envelope(
            from: new Address(env('MAIL_USERNAME'), env('MAIL_FROM_NAME')),
            subject: $this->subject
        );
    }

    public function build()
    {
        return $this->view('mails.storie.comment', [
            'user' => $this->user,
            'content' => $this->content
        ]);
    }
}
