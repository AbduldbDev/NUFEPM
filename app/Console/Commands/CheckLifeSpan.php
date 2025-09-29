<?php

namespace App\Console\Commands;

use App\Mail\LifeSpanReminder;
use Illuminate\Console\Command;
use App\Models\Extinguishers;
use App\Models\Notification;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class CheckLifeSpan extends Command
{
    protected $signature = 'lifespan:check';
    protected $description = 'Check extinguishers for upcoming expiration of fire equipment and notify users';

    public function handle()
    {
        $users = User::all();
        $today = now();
        $limit = now()->addDays(30);

        $extinguishers = Extinguishers::whereBetween('life_span', [$today, $limit])->get();

        if ($extinguishers->count() > 0) {
            foreach ($users as $user) {
                foreach ($extinguishers as $extinguisher) {
                    $alreadyNotified = Notification::where('user_id', $user->id)
                        ->where('type', 'expiration')
                        ->where('notifiable_id', $extinguisher->id)
                        ->whereDate('created_at', $today)
                        ->exists();

                    if (!$alreadyNotified) {
                        Notification::create([
                            'user_id' => $user->id,
                            'notifiable_type' => "Near Expiration",
                            'notifiable_id' => $extinguisher->id,
                            'type' => 'expiration',
                            'message' => "Extinguisher {$extinguisher->extinguisher_id} is expiring on " .
                                Carbon::parse($extinguisher->life_span)->format('M d, Y') . ".",
                        ]);
                    }
                }

                $earliestExpiration = Carbon::parse($extinguishers->min('life_span'))->format('M d, Y');
                Mail::to($user->email)->send(new LifeSpanReminder($extinguishers, $earliestExpiration));
            }
        }

        $this->info('Near Expiration notifications checked.');
    }
}
