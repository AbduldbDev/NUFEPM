<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class OverDueLifeSpan extends Mailable
{
   use Queueable, SerializesModels;

    public $extinguishers;
    public $formattedDate;

    /**
     * Create a new message instance.
     *
     * @param \Illuminate\Support\Collection $extinguishers
     * @param string $dueDate
     */
    public function __construct(Collection $extinguishers, string $formattedDate)
    {
        $this->extinguishers = $extinguishers;
        $this->formattedDate = $formattedDate;
    }

    public function build()
    {
        return $this->subject('Expired Equipment Reminder')
            ->markdown('emails.maintenance.overdue_lifespan');
    }
}
