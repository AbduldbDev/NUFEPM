<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InspectionLogs;
use App\Models\InspectionAnswer;
use App\Models\Extinguishers;
use App\Models\ExtinguisherRefill;
use App\Models\Buildings;
use Illuminate\Support\Facades\DB;

class InspectionLogsController extends Controller
{
    public function ShowRecentLogs()
    {
        $latestIds = InspectionLogs::select(DB::raw('MAX(id) as id'))->groupBy('extinguisher_id')->pluck('id');
        $items = InspectionLogs::with(['user', 'extinguisher'])->whereIn('id', $latestIds)->latest()->paginate(100);
        return view('Admin.inspections.recent', compact('items'));
    }

    public function ShowInspectionAnswer($id)
    {
        $details = InspectionLogs::with(['user', 'extinguisher'])->find($id);
        $items = InspectionAnswer::with(['questions'])->where('inspection_id', $details->id)->get();
        return view('Admin.inspections.answers', compact('details', 'items'));
    }

    public function ShowInspectionExtinguishers()
    {

        $items = Buildings::withCount([
            'extinguishers as extinguisher_count' => function ($q) {
                $q->where('status', '!=', 'Retired');
            }
        ])->get();


        $url = '/Inspection/Logs/Extinguishers/';
        $type = "Active Extinguishers";
        $total = Extinguishers::where('status', '!=', 'Retired')->count();
        return view('Admin.SubMenu.BuildingsMenu', compact('items', 'url', 'type', 'total'));
    }

    public function ShowTypeInspectionExtinguishers($type)
    {
        $base = Extinguishers::with(['location', 'user'])
            ->where('status', '!=', 'Retired');

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

        return view('Admin.inspections.extinguishers', compact(
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

    public function ShowInspectionLogsTable($id)
    {
        $items = InspectionLogs::with(['user', 'extinguisher'])->where('extinguisher_id', $id)->latest()->paginate(100);
        $details = Extinguishers::find($id);

        return view('Admin.inspections.logstable', compact('items', 'details'));
    }
}
