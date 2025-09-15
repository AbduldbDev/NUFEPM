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

        if ($overdueExtinguishers->count() === 0) {
            $this->info('No overdue extinguishers found.');
            return;
        }

        $extIds = $overdueExtinguishers->pluck('extinguisher_id')->implode(', ');
        $earliestExpiration = Carbon::parse($overdueExtinguishers->min('life_span'))->format('M d, Y');

        foreach ($users as $user) {
            $alreadyNotified = Notification::where('user_id', $user->id)
                ->where('type', 'overdue')
                ->whereDate('created_at', $today)
                ->exists();

            if (!$alreadyNotified) {
                $message = "The following extinguishers have been expired since {$earliestExpiration}: {$extIds}.";

                Notification::create([
                    'user_id' => $user->id,
                    'notifiable_type' => "Expired",
                    'type' => 'overdue',
                    'message' => $message,
                ]);

                Mail::to($user->email)->send(new OverDueLifeSpan($overdueExtinguishers, $earliestExpiration));
            }
        }

        $this->info('Overdue expiration notifications checked.');
    }
}
