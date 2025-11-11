<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use App\Models\Extinguishers;
use App\Models\Equipment;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('notifications.index', compact('notifications'));
    }

    public function markAllRead()
    {
        Notification::where('user_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return back()->with('success', 'All notifications marked as read.');
    }
    public function markRead($id)
    {
        $notif = Notification::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $notif->update(['is_read' => true]);

        return back()->with('success', 'Notification marked as read.');
    }

    public function destroy($id)
    {
        $notification = Notification::where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        $notification->delete();

        return back()->with('success', 'Notification deleted.');
    }


    public function NearMaintenance()
    {
        $type = 'all';
        $today = now();
        $limit = now()->addDays(30);
        $base = Extinguishers::with(['location', 'user'])->whereBetween('next_maintenance', [$today, $limit])->where('status', '!=', 'Retired');

        if ($type !== 'all') {
            $base->whereHas('location', function ($q) use ($type) {
                $q->where('building', $type);
            });
        }

        $items = (clone $base)->orderBy('id', 'desc')->paginate(100);

        $totalExtinguishers = (clone $base)->where('category', 'Extinguisher')->count();
        $totalFireHose = (clone $base)->where('category', 'Fire_Hose')->count();


        $nearExpirationQuery = (clone $base)->whereDate('life_span', '<=', now()->addDays(30));
        $nearExpiration = $nearExpirationQuery->count();
        $nearestExpirationDate = $nearExpirationQuery->orderBy('life_span', 'asc')->value('life_span');

        $nearInspectionQuery = (clone $base)->whereDate('next_maintenance', '<=', now()->addDays(30));
        $nearInspection = $nearInspectionQuery->count();
        $nearestInspectionDate = $nearInspectionQuery->orderBy('next_maintenance', 'asc')->value('next_maintenance');

        return view('Admin.extinguisher.table', compact(
            'items',
            'type',
            'totalExtinguishers',
            'nearExpiration',
            'nearestExpirationDate',
            'nearInspection',
            'nearestInspectionDate',
            'totalFireHose'
        ));
    }

    public function OverDueInspection()
    {
        $type = 'all';
        $today = now();
        $base = Extinguishers::with(['location', 'user'])->whereDate('next_maintenance', '<', $today)->where('status', '!=', 'Retired');

        if ($type !== 'all') {
            $base->whereHas('location', function ($q) use ($type) {
                $q->where('building', $type);
            });
        }

        $items = (clone $base)->orderBy('id', 'desc')->paginate(100);

        $totalExtinguishers = (clone $base)->where('category', 'Extinguisher')->count();
        $totalFireHose = (clone $base)->where('category', 'Fire_Hose')->count();


        $nearExpirationQuery = (clone $base)->whereDate('life_span', '<=', now()->addDays(30));
        $nearExpiration = $nearExpirationQuery->count();
        $nearestExpirationDate = $nearExpirationQuery->orderBy('life_span', 'asc')->value('life_span');

        $nearInspectionQuery = (clone $base)->whereDate('next_maintenance', '<=', now()->addDays(30));
        $nearInspection = $nearInspectionQuery->count();
        $nearestInspectionDate = $nearInspectionQuery->orderBy('next_maintenance', 'asc')->value('next_maintenance');

        return view('Admin.extinguisher.table', compact(
            'items',
            'type',
            'totalExtinguishers',
            'nearExpiration',
            'nearestExpirationDate',
            'nearInspection',
            'nearestInspectionDate',
            'totalFireHose'
        ));
    }

    public function ExpiredLifeSpan()
    {
        $type = 'all';
        $today = now();
        $base = Extinguishers::with(['location', 'user'])->whereDate('life_span', '<', $today)->where('status', '!=', 'Retired');

        if ($type !== 'all') {
            $base->whereHas('location', function ($q) use ($type) {
                $q->where('building', $type);
            });
        }

        $items = (clone $base)->orderBy('id', 'desc')->paginate(100);

        $totalExtinguishers = (clone $base)->where('category', 'Extinguisher')->count();
        $totalFireHose = (clone $base)->where('category', 'Fire_Hose')->count();


        $nearExpirationQuery = (clone $base)->whereDate('life_span', '<=', now()->addDays(30));
        $nearExpiration = $nearExpirationQuery->count();
        $nearestExpirationDate = $nearExpirationQuery->orderBy('life_span', 'asc')->value('life_span');

        $nearInspectionQuery = (clone $base)->whereDate('next_maintenance', '<=', now()->addDays(30));
        $nearInspection = $nearInspectionQuery->count();
        $nearestInspectionDate = $nearInspectionQuery->orderBy('next_maintenance', 'asc')->value('next_maintenance');

        return view('Admin.extinguisher.table', compact(
            'items',
            'type',
            'totalExtinguishers',
            'nearExpiration',
            'nearestExpirationDate',
            'nearInspection',
            'nearestInspectionDate',
            'totalFireHose'
        ));
    }

    public function NearExpiration()
    {
        $type = 'all';
        $limit = now()->addDays(30);
        $today = now();
        $base = Extinguishers::with(['location', 'user'])->whereBetween('life_span', [$today, $limit])->where('status', '!=', 'Retired');

        if ($type !== 'all') {
            $base->whereHas('location', function ($q) use ($type) {
                $q->where('building', $type);
            });
        }

        $items = (clone $base)->orderBy('id', 'desc')->paginate(100);

        $totalExtinguishers = (clone $base)->where('category', 'Extinguisher')->count();
        $totalFireHose = (clone $base)->where('category', 'Fire_Hose')->count();


        $nearExpirationQuery = (clone $base)->whereDate('life_span', '<=', now()->addDays(30));
        $nearExpiration = $nearExpirationQuery->count();
        $nearestExpirationDate = $nearExpirationQuery->orderBy('life_span', 'asc')->value('life_span');

        $nearInspectionQuery = (clone $base)->whereDate('next_maintenance', '<=', now()->addDays(30));
        $nearInspection = $nearInspectionQuery->count();
        $nearestInspectionDate = $nearInspectionQuery->orderBy('next_maintenance', 'asc')->value('next_maintenance');

        return view('Admin.extinguisher.table', compact(
            'items',
            'type',
            'totalExtinguishers',
            'nearExpiration',
            'nearestExpirationDate',
            'nearInspection',
            'nearestInspectionDate',
            'totalFireHose'
        ));
    }

    public function NearExpirationDevice()
    {
        $type = 'all';

        $base = Equipment::with(['location', 'user', 'latestCertificate'])
            ->where('status', 'Active')
            ->whereHas('latestCertificate', function ($q) {
                $q->whereBetween('expiry_date', [
                    now(),
                    now()->addDays(30)
                ]);
            });

        if ($type !== 'all') {
            $base->whereHas('location', function ($q) use ($type) {
                $q->where('building', $type);
            });
        }

        $items = (clone $base)->orderBy('id', 'desc')->paginate(100);

        $sprinkler = (clone $base)->where('type', 'sprinkler')->count();
        $smokedetector = (clone $base)->where('type', 'smoke_detector')->count();
        $emergencylights = (clone $base)->where('type', 'emergency_lights')->count();
        $firealarm = (clone $base)->where('type', 'fire_alarm')->count();

        return view('Admin.Device.table', compact(
            'items',
            'type',
            'sprinkler',
            'smokedetector',
            'emergencylights',
            'firealarm'
        ));
    }


    public function ExpiredDevice()
    {
        $type = 'all';
        $base = Equipment::with(['location', 'user', 'latestCertificate'])
            ->where('status', 'Active')
            ->whereHas('latestCertificate', function ($q) {
                $q->where('expiry_date', '<', now());
            });

        if ($type !== 'all') {
            $base->whereHas('location', function ($q) use ($type) {
                $q->where('building', $type);
            });
        }

        $items = (clone $base)->orderBy('id', 'desc')->paginate(100);

        $sprinkler = (clone $base)->where('type', 'sprinkler')->count();
        $smokedetector = (clone $base)->where('type', 'smoke_detector')->count();
        $emergencylights = (clone $base)->where('type', 'emergency_lights')->count();
        $firealarm = (clone $base)->where('type', 'fire_alarm')->count();

        return view('Admin.Device.table', compact(
            'items',
            'type',
            'sprinkler',
            'smokedetector',
            'emergencylights',
            'firealarm'
        ));
    }
}
