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

        if ($extinguishers->count() > 0) {
            $extIds = $extinguishers->pluck('extinguisher_id')->implode(', ');
            $oldestDue = Carbon::parse($extinguishers->min('next_maintenance'))->format('M d, Y');

            foreach ($users as $user) {
                $alreadyNotified = Notification::where('user_id', $user->id)
                    ->where('type', 'overdue_mainenance')
                    ->whereDate('created_at', $today)
                    ->exists();

                if (!$alreadyNotified) {
                    Notification::create([
                        'user_id' => $user->id,
                        'notifiable_type' => "Over_due",
                        'type' => 'overdue_mainenance',
                        'message' => "The following extinguishers are overdue for maintenance since " .
                            $oldestDue . ": {$extIds}.",
                    ]);

                    Mail::to($user->email)->send(new OverDueMaintenance($extinguishers, $oldestDue));
                 }
            }
        }

        $this->info('Overdue maintenance notifications checked.');
    }
}
