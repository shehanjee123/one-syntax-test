<?php

namespace App\Mail;

use App\Models\WebsitePost;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SubcriptionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $websitePost;

    /**
     * Create a new message instance.
     */
    public function __construct(WebsitePost $websitePost)
    {
        $this->websitePost = $websitePost;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Post are published'. $this->websitePost->post_title,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        \Log::info('Generating post link for:', ['post_id' => $this->websitePost->id]);
        return new Content(
            view: 'frontend.emails.subscription',
            with: [
                'post_title' => $this->websitePost->post_title,
                'post_description' => $this->websitePost->post_description,
                'url' => route('post.show', $this->websitePost->id),
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
