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
            $extIds = $extinguishers->pluck('extinguisher_id')->implode(', ');
            $dueDate = \Carbon\Carbon::parse($extinguishers->min('next_maintenance'))->format('M d, Y');

            foreach ($users as $user) {
                $alreadyNotified = Notification::where('user_id', $user->id)
                    ->where('type', 'maintenance')
                    ->whereDate('created_at', $today)
                    ->exists();

                if (!$alreadyNotified) {
                    Notification::create([
                        'user_id' => $user->id,
                        'notifiable_type' => "Maintenance",
                        'type' => 'maintenance',
                        'message' => "The following extinguishers require maintenance by " .
                            \Carbon\Carbon::parse($extinguishers->min('next_maintenance'))->format('M. d, Y') .
                            ": {$extIds}.",
                    ]);
                    Mail::to($user->email)->send(new MaintenanceReminderMail($extinguishers, $dueDate));
                }
            }
        }
        $this->info('Maintenance notifications checked.');
    }
}
