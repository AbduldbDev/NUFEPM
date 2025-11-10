<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\InspectionCertificate;
use App\Models\Equipment;
use App\Models\Notification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\ExpiredCertificateReminderMail;

class CheckExpiredCertificates extends Command
{
    protected $signature = 'certificate:expired';
    protected $description = 'Check expired equipment certificates and notify users';

    public function handle()
    {
        $users = User::whereIn('type', ['admin', 'maintenance'])->get();

        $today = now();

        $expiredEquipment = Equipment::with('latestCertificate', 'location')
            ->whereHas('latestCertificate', function ($query) use ($today) {
                $query->where('expiry_date', '<', $today);
            })
            ->get();

        $expiredCount = $expiredEquipment->count();
        $totalEquipment = Equipment::count();

        if ($expiredCount === 0) {
            $this->info('No expired equipment certificates found.');
            return;
        }

        $percentage = round(($expiredCount / $totalEquipment) * 100, 2);
        $earliestExpiredDate = Carbon::parse($expiredEquipment->min('expiry_date'))->format('M d, Y');

        foreach ($users as $user) {

            // Avoid duplicate notification per day
            $alreadyNotified = Notification::where('user_id', $user->id)
                ->where('type', 'certificate_expired')
                ->whereDate('created_at', $today)
                ->exists();

            if (!$alreadyNotified) {

                Notification::create([
                    'user_id' => $user->id,
                    'notifiable_type' => 'Certificate Expired',
                    'notifiable_id' => $user->id,
                    'type' => 'certificate_expired',
                    'message' => "{$expiredCount}/{$totalEquipment} equipment certificates ({$percentage}%) have EXPIRED (earliest: {$earliestExpiredDate}). Immediate renewal required."
                ]);


                Mail::to($user->email)->send(
                    new ExpiredCertificateReminderMail($expiredEquipment, $earliestExpiredDate)
                );
            }
        }

        $this->info("Expired certificate notifications sent successfully.");
    }
}
