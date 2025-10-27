<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Extinguishers;
use App\Models\Notification;
use App\Models\User;
use Carbon\Carbon;
use App\Mail\OverDueLifeSpan;
use Illuminate\Support\Facades\Mail;

class CheckOverdueLifeSpan extends Command
{
    protected $signature = 'lifespan:overdue';
    protected $description = 'Check extinguishers that are overdue expiration and notify users';

    public function handle()
    {
        $users = User::all();
        $today = Carbon::today();

        // Get all extinguishers and overdue ones
        $totalExtinguishers = Extinguishers::count();
        $overdueExtinguishers = Extinguishers::whereDate('life_span', '<', $today)->get();

        if ($totalExtinguishers === 0) {
            $this->info('No extinguishers found.');
            return;
        }

        $overdueCount = $overdueExtinguishers->count();
        $percentage = round(($overdueCount / $totalExtinguishers) * 100, 2);

        if ($overdueCount > 0) {
            $earliestExpiration = Carbon::parse($overdueExtinguishers->min('life_span'))->format('M d, Y');

            foreach ($users as $user) {
                $alreadyNotified = Notification::where('user_id', $user->id)
                    ->where('type', 'overdue')
                    ->whereDate('created_at', $today)
                    ->exists();

                if (!$alreadyNotified) {
                    Notification::create([
                        'user_id' => $user->id,
                        'notifiable_type' => 'Expired',
                        'notifiable_id' => $user->id,
                        'type' => 'overdue',
                        'message' => "{$overdueCount}/{$totalExtinguishers} extinguishers ({$percentage}%) have expired since {$earliestExpiration}.",
                    ]);

                    Mail::to($user->email)->send(new OverDueLifeSpan($overdueExtinguishers, $earliestExpiration));
                }
            }

            $this->info('Overdue lifespan summary notifications sent successfully.');
        } else {
            $this->info('No overdue extinguishers found.');
        }
    }
}
