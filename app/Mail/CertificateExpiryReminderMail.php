<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CertificateExpiryReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $dueCertificates;
    public $earliestExpiry;

    public function __construct($dueCertificates, $earliestExpiry)
    {
        $this->dueCertificates = $dueCertificates;
        $this->earliestExpiry = $earliestExpiry;
    }

    public function build()
    {
        return $this->subject('Upcoming Equipment Certificate Expiry Notice')
            ->view('emails.maintenance.certificate_expiry_reminder');
    }
}
