<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailVerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $type;
    public $data;

    /**
     * Create a new message instance.
     *
     * @param string $type
     * @param array $data
     */
    public function __construct($type, $data)
    {
        $this->type = $type;
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        // Set the subject based on the email type
        $subject = $this->type == 'email_verification' ? 'Email Verification Mail' : 'Login Credentials';

        return new Envelope(
            subject: $subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $user = isset($this->data['user']) ?$this->data['user']: null; 
        $otp = isset($this->data['otp']) ? $this->data['otp'] : null;        
        $plainPassword = isset($this->data['plain_password']) ? $this->data['plain_password'] : null;  

        return new Content(
            view: 'emails.verify-email',
            with: [
                'user' => $user,
                'otp' => $otp,                      
                'plain_password' => $plainPassword,  
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
