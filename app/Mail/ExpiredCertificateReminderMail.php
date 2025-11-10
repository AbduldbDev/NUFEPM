<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ExpiredCertificateReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $expiredEquipment;
    public $earliestExpiredDate;

    public function __construct($expiredEquipment, $earliestExpiredDate)
    {
        $this->expiredEquipment = $expiredEquipment;
        $this->earliestExpiredDate = $earliestExpiredDate;
    }

    public function build()
    {
        return $this->subject('URGENT: Expired Equipment Certificate Notice')
            ->view('emails.maintenance.expired_certificate_reminder');
    }
}
