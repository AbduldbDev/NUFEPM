<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;


class OverDueMaintenance extends Mailable
{
     use Queueable, SerializesModels;

    public $extinguishers;
    public $oldestDue;

    /**
     * Create a new message instance.
     *
     * @param \Illuminate\Support\Collection $extinguishers
     * @param string $dueDate
     */
    public function __construct(Collection $extinguishers, string $oldestDue)
    {
        $this->extinguishers = $extinguishers;
        $this->oldestDue = $oldestDue;
    }

    public function build()
    {
        return $this->subject('Over Due Maintenance Reminder')
            ->markdown('emails.maintenance.overdue_maintenance');
    }
}
