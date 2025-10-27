<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Extinguishers;
use App\Models\Notification;
use Carbon\Carbon;
use App\Models\User;
use App\Mail\OverDueMaintenance;
use Illuminate\Support\Facades\Mail;

class CheckOverdueMaintenance extends Command
{
    protected $signature = 'maintenance:overdue';
    protected $description = 'Check extinguishers with overdue maintenance and notify users';

    public function handle()
    {
        $users = User::all();
        $today = now();

        // All extinguishers and overdue extinguishers
        $totalExtinguishers = Extinguishers::count();
        $overdueExtinguishers = Extinguishers::whereDate('next_maintenance', '<', $today)->get();

        if ($totalExtinguishers === 0) {
            $this->info('No extinguishers found.');
            return;
        }

        $overdueCount = $overdueExtinguishers->count();
        $percentage = round(($overdueCount / $totalExtinguishers) * 100, 2);

        if ($overdueCount > 0) {
            $oldestDue = Carbon::parse($overdueExtinguishers->min('next_maintenance'))->format('M d, Y');

            foreach ($users as $user) {
                $alreadyNotified = Notification::where('user_id', $user->id)
                    ->where('type', 'overdue_maintenance')
                    ->whereDate('created_at', $today)
                    ->exists();

                if (!$alreadyNotified) {
                    Notification::create([
                        'user_id' => $user->id,
                        'notifiable_type' => 'Over due',
                        'notifiable_id' => $user->id,
                        'type' => 'overdue_maintenance',
                        'message' => "{$overdueCount}/{$totalExtinguishers} extinguishers ({$percentage}%) are overdue for maintenance since {$oldestDue}.",
                    ]);


                    Mail::to($user->email)->send(new OverDueMaintenance($overdueExtinguishers, $oldestDue));
                }
            }

            $this->info('Overdue maintenance summary notifications sent.');
        } else {
            $this->info('No overdue maintenance extinguishers found.');
        }
    }
}
