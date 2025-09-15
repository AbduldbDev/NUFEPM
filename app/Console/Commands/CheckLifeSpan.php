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

        $extinguishers = Extinguishers::where('life_span', '>=', $today)
            ->where('life_span', '<=', $limit)
            ->get();

        if ($extinguishers->count() > 0) {
            $extIds = $extinguishers->pluck('extinguisher_id')->implode(', ');
            $earliestExpiration = Carbon::parse($extinguishers->min('life_span'))->format('M d, Y');

            foreach ($users as $user) {
                $alreadyNotified = Notification::where('user_id', $user->id)
                    ->where('type', 'expiration')
                    ->whereDate('created_at', $today)
                    ->exists();

                if (!$alreadyNotified) {
                    Notification::create([
                        'user_id' => $user->id,
                        'notifiable_type' => "Near Expiration",
                        'type' => 'expiration',
                        'message' => "The following extinguishers are expiring by " . $earliestExpiration . ": {$extIds}.",
                    ]);

                    Mail::to($user->email)->send(new LifeSpanReminder($extinguishers, $earliestExpiration));
                }
            }
        }

        $this->info('Near Expiration notifications checked.');
    }
}
