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

        $totalExtinguishers = Extinguishers::count();
        $dueExtinguishers = Extinguishers::whereBetween('next_maintenance', [$today, $limit])->get();

        if ($totalExtinguishers === 0) {
            $this->info('No extinguishers found.');
            return;
        }

        $dueCount = $dueExtinguishers->count();
        $percentage = round(($dueCount / $totalExtinguishers) * 100, 2);

        if ($dueCount > 0) {
            $dueDate = Carbon::parse($dueExtinguishers->min('next_maintenance'))->format('M d, Y');

            foreach ($users as $user) {
                $alreadyNotified = Notification::where('user_id', $user->id)
                    ->where('type', 'maintenance')
                    ->whereDate('created_at', $today)
                    ->exists();

                if (!$alreadyNotified) {
                    Notification::create([
                        'user_id' => $user->id,
                        'notifiable_type' => 'Maintenance',
                        'notifiable_id' => $user->id,
                        'type' => 'maintenance',
                        'message' => "{$dueCount}/{$totalExtinguishers} extinguishers ({$percentage}%) are due for maintenance this month (before {$dueDate}).",
                    ]);

                    Mail::to($user->email)->send(
                        new MaintenanceReminderMail($dueExtinguishers, $dueDate)
                    );
                }
            }

            $this->info("Maintenance summary notifications sent successfully.");
        } else {
            $this->info('No extinguishers due for maintenance within the next 30 days.');
        }
    }
}
