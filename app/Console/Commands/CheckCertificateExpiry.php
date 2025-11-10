<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Equipment;
use App\Models\InspectionCertificate;
use App\Models\Notification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\CertificateExpiryReminderMail;

class CheckCertificateExpiry extends Command
{
    protected $signature = 'certificate:check';
    protected $description = 'Check upcoming certificate expirations and notify users';

    public function handle()
    {
        $users = User::whereIn('type', ['admin', 'maintenance'])->get();

        $today = now();
        $limit = now()->addDays(30);

        $dueCertificates  = Equipment::whereHas('latestCertificate', function ($q) {
            $q->whereBetween('expiry_date', [now(), now()->addDays(30)]);
        })->get();


        $dueCount = $dueCertificates->count();
        $totalEquipment = Equipment::count();

        if ($dueCount === 0) {
            $this->info('No equipment certificates expiring within 30 days.');
            return;
        }

        $percentage = round(($dueCount / $totalEquipment) * 100, 2);
        $earliestExpiry = Carbon::parse($dueCertificates->min('expiry_date'))->format('M d, Y');

        foreach ($users as $user) {

            // Prevent duplicate notifications today (timezone-safe)
            $alreadyNotified = Notification::where('user_id', $user->id)
                ->where('type', 'certificate_expiry')
                ->whereBetween('created_at', [now()->startOfDay(), now()->endOfDay()])
                ->exists();

            if (!$alreadyNotified) {

                Notification::create([
                    'user_id' => $user->id,
                    'notifiable_type' => 'Certificate Expiry',
                    'notifiable_id' => $user->id,
                    'type' => 'certificate_expiry',
                    'message' => "{$dueCount}/{$totalEquipment} equipment certificates ({$percentage}%) will expire soon (before {$earliestExpiry})."
                ]);

                // ensure immediate send (no queue required)
                Mail::to($user->email)->sendNow(
                    new CertificateExpiryReminderMail($dueCertificates, $earliestExpiry)
                );
            }
        }

        $this->info("Certificate expiry emails & notifications sent successfully.");
    }
}
