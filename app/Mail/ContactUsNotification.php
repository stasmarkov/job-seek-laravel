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
class ContactUsNotification extends Mailable {

  use Queueable, SerializesModels;

  /**
   * Create a new message instance.
   */
  public function __construct(public string $contactMessage) {}

  /**
   * Get the message envelope.
   */
  public function envelope(): Envelope {
    /** @var \App\Models\Employer $current_employer */
    $current_employer = Context::get('current_user_employer');
    /** @var \App\Models\User $current_user */
    $current_user = Context::get('current_user');

    return new Envelope(
      to: 'admin@example.com',
      from: new Address($current_user->email, $current_employer->name),
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
        'user' => Context::get('current_user'),
        'employer' => Context::get('current_user_employer'),
        'contactMessage' => $this->contactMessage,
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
