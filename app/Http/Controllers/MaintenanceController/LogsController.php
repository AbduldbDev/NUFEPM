<?php

namespace App\Http\Controllers\MaintenanceController;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InspectionLogs;
use App\Models\InspectionAnswer;
use App\Models\Extinguishers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LogsController extends Controller
{
    public function ShowRecentInspected()
    {
        $latestIds = InspectionLogs::select(DB::raw('MAX(id) as id'))->groupBy('extinguisher_id')->pluck('id');
        $items = InspectionLogs::with(['user', 'extinguisher'])->where('inspected_by', Auth::id())->latest()->paginate(20);
        return view('Maintenance.logs.logs', compact('items'));
    }

    public function ShowInspectionAnswer($id)
    {
        $details = InspectionLogs::with(['user', 'extinguisher'])->find($id);
        $items = InspectionAnswer::with(['questions'])->where('inspection_id', $details->id)->get();
        return view('Maintenance.logs.answers', compact('details', 'items'));
    }

    public function ShowInspectionLogs($id)
    {
        $items = InspectionLogs::with(['user', 'extinguisher'])->where('extinguisher_id', $id)->latest()->paginate(20);
        $details = Extinguishers::find($id);
        return view('Maintenance.logs.history', compact('items', 'details'));
    }


    public function ShowNearInspection()
    {
        $today = Carbon::today();
        $thirtyDaysFromNow = Carbon::today()->addDays(30);
        $thirtyDaysAgo = Carbon::today()->subDays(30);

        $items = Extinguishers::with(['location'])
            ->whereBetween('next_maintenance', [$today, $thirtyDaysFromNow])
            ->orWhereBetween('next_maintenance', [$thirtyDaysAgo, $today])
            ->orderBy('next_maintenance', 'asc')
            ->paginate(20);

        return view('Maintenance.Logs.schedule', compact('items'));
    }
}
