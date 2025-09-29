<?php

namespace App\Console\Commands;

use App\Mail\OverDueMaintenance;
use Illuminate\Console\Command;
use App\Models\Extinguishers;
use App\Models\Notification;
use Carbon\Carbon;
use App\Models\User;
use App\Mail\OverdueMaintenanceMail;
use Illuminate\Support\Facades\Mail;

class CheckOverdueMaintenance extends Command
{
    protected $signature = 'maintenance:overdue';
    protected $description = 'Check extinguishers with overdue maintenance and notify users';

    public function handle()
    {
        $users = User::all();
        $today = now();

        $extinguishers = Extinguishers::whereDate('next_maintenance', '<', $today)->get();

        if ($extinguishers->isEmpty()) {
            $this->info('No overdue maintenance extinguishers found.');
            return;
        }

        foreach ($users as $user) {
            foreach ($extinguishers as $extinguisher) {
                $alreadyNotified = Notification::where('user_id', $user->id)
                    ->where('type', 'overdue_maintenance')
                    ->where('notifiable_id', $extinguisher->id)
                    ->whereDate('created_at', $today)
                    ->exists();

                if (!$alreadyNotified) {
                    Notification::create([
                        'user_id' => $user->id,
                        'notifiable_type' => "Over due",
                        'notifiable_id' => $extinguisher->id,
                        'type' => 'overdue_maintenance',
                        'message' => "Extinguisher {$extinguisher->extinguisher_id} has been overdue for maintenance since " .
                            Carbon::parse($extinguisher->next_maintenance)->format('M d, Y') . ".",
                    ]);
                }
            }

            $oldestDue = Carbon::parse($extinguishers->min('next_maintenance'))->format('M d, Y');
            Mail::to($user->email)->send(new OverDueMaintenance($extinguishers, $oldestDue));
        }

        $this->info('Overdue maintenance notifications checked.');
    }
}
