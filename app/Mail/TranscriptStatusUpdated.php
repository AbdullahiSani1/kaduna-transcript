<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\TranscriptRequest;

class TranscriptStatusUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public TranscriptRequest $transcriptRequest) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Transcript Request Update - ' . $this->transcriptRequest->reference_number,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.transcript-status-updated',
        );
    }
}