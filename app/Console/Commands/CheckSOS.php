<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SOSReport;
use App\Models\Notification;

class CheckSOS extends Command
{
    protected $signature = 'sos:check';
    protected $description = 'Check for new SOS reports and notify admins';

    public function handle()
    {
        $sosReports = SOSReport::where('notified', false)->get();

        foreach ($sosReports as $report) {
            // Notify admins (example)
            $admins = \App\Models\User::whereIn('role', ['admin', 'engineer'])->get();
            foreach ($admins as $admin) {
                Notification::create([
                    'user_id' => $admin->id,
                    'notifiable_type' => 'sos',
                    'type' => 'sos',
                    'message' => "SOS Report: {$report->description} at {$report->location}",
                ]);
            }
        }

        $this->info('SOS notifications sent.');
    }
}
