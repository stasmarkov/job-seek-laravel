<?php

declare(strict_types = 1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Context;

/**
 * The contact us mail.
 */
class ContactUsMail extends Mailable {

  use Queueable, SerializesModels;

  /**
   * Create a new message instance.
   */
  public function __construct(public array $data) {}

  /**
   * Get the message envelope.
   */
  public function envelope(): Envelope {
    return new Envelope(
      to: 'admin@example.com',
      from: new Address($this->data['email'], $this->data['first_name'] . ' ' . $this->data['last_name']),
      subject: 'Contact Us',
    );
  }

  /**
   * Get the message content definition.
   */
  public function content(): Content {
    return new Content(
      view: 'emails.contact',
      with: [
        'data' => $this->data,
      ]
    );
  }

  /**
   * Get the attachments for the message.
   *
   * @return array<int, \Illuminate\Mail\Mailables\Attachment>
   */
  public function attachments(): array {
    return [];
  }

}
