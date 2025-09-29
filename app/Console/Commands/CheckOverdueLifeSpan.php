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

        $overdueExtinguishers = Extinguishers::whereDate('life_span', '<', $today)->get();

        if ($overdueExtinguishers->isEmpty()) {
            $this->info('No overdue extinguishers found.');
            return;
        }

        foreach ($users as $user) {
            foreach ($overdueExtinguishers as $extinguisher) {
                $alreadyNotified = Notification::where('user_id', $user->id)
                    ->where('type', 'overdue')
                    ->where('notifiable_id', $extinguisher->id)
                    ->whereDate('created_at', $today)
                    ->exists();

                if (!$alreadyNotified) {
                    Notification::create([
                        'user_id' => $user->id,
                        'notifiable_type' => "Expired",
                        'notifiable_id' => $extinguisher->id,
                        'type' => 'overdue',
                        'message' => "Extinguisher {$extinguisher->extinguisher_id} expired on " .
                            Carbon::parse($extinguisher->life_span)->format('M d, Y') . ".",
                    ]);
                }
            }

    
            $earliestExpiration = Carbon::parse($overdueExtinguishers->min('life_span'))->format('M d, Y');
            Mail::to($user->email)->send(new OverDueLifeSpan($overdueExtinguishers, $earliestExpiration));
        }

        $this->info('Overdue expiration notifications checked.');
    }
}
