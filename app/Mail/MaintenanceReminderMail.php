<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;

class MaintenanceReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $extinguishers;
    public $dueDate;

    /**
     * Create a new message instance.
     *
     * @param \Illuminate\Support\Collection $extinguishers
     * @param string $dueDate
     */
    public function __construct(Collection $extinguishers, string $dueDate)
    {
        $this->extinguishers = $extinguishers;
        $this->dueDate = $dueDate;
    }

    public function build()
    {
        return $this->subject('Equipment Maintenance Reminder')
            ->markdown('emails.maintenance.reminder');
    }
}
