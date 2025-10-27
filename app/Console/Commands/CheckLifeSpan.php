<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Extinguishers;
use App\Models\Notification;
use Carbon\Carbon;
use App\Models\User;
use App\Mail\LifeSpanReminder;
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

        $totalExtinguishers = Extinguishers::count();
        $expiringSoon = Extinguishers::whereBetween('life_span', [$today, $limit])->get();

        if ($totalExtinguishers === 0) {
            $this->info('No extinguishers found.');
            return;
        }

        $expiringCount = $expiringSoon->count();
        $percentage = round(($expiringCount / $totalExtinguishers) * 100, 2);

        if ($expiringCount > 0) {
            $earliestExpiration = Carbon::parse($expiringSoon->min('life_span'))->format('M d, Y');

            foreach ($users as $user) {
                $alreadyNotified = Notification::where('user_id', $user->id)
                    ->where('type', 'expiration')
                    ->whereDate('created_at', $today)
                    ->exists();

                if (!$alreadyNotified) {
                    Notification::create([
                        'user_id' => $user->id,
                        'notifiable_type' => 'Near Expiration',
                        'notifiable_id' => $user->id,
                        'type' => 'expiration',
                        'message' => "{$expiringCount}/{$totalExtinguishers} extinguishers ({$percentage}%) are nearing expiration (before {$earliestExpiration}).",
                    ]);

                    Mail::to($user->email)->send(new LifeSpanReminder($expiringSoon, $earliestExpiration));
                }
            }

            $this->info('Life span summary notifications sent successfully.');
        } else {
            $this->info('No extinguishers nearing expiration within the next 30 days.');
        }
    }
}
