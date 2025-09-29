<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Extinguishers;
use App\Models\Notification;
use Carbon\Carbon;
use App\Models\User;
use App\Mail\MaintenanceReminderMail;
use Illuminate\Support\Facades\Mail;

class CheckMaintenance extends Command
{
    protected $signature = 'maintenance:check';
    protected $description = 'Check extinguishers for upcoming maintenance and notify users';

    public function handle()
    {
        $users = User::all();

        $today = now();
        $limit = now()->addDays(30);

        $extinguishers = Extinguishers::whereBetween('next_maintenance', [$today, $limit])->get();

        if ($extinguishers->count() > 0) {
            $dueDate = \Carbon\Carbon::parse($extinguishers->min('next_maintenance'))->format('M d, Y');

            foreach ($users as $user) {
                foreach ($extinguishers as $extinguisher) {
                    $alreadyNotified = Notification::where('user_id', $user->id)
                        ->where('type', 'maintenance')
                        ->where('notifiable_id', $extinguisher->id)
                        ->whereDate('created_at', $today)
                        ->exists();

                    if (!$alreadyNotified) {
                        Notification::create([
                            'user_id' => $user->id,
                            'notifiable_type' => "Maintenance",
                            'notifiable_id' => $extinguisher->id,
                            'type' => 'maintenance',
                            'message' => "Extinguisher {$extinguisher->extinguisher_id} requires maintenance by " .
                                \Carbon\Carbon::parse($extinguisher->next_maintenance)->format('M d, Y') . ".",
                        ]);
                    }
                }

                Mail::to($user->email)->send(new MaintenanceReminderMail($extinguishers, $dueDate));
            }
        }

        $this->info('Maintenance notifications checked.');
    }
}
