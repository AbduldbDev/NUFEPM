<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InspectionLogs;
use App\Models\InspectionAnswer;
use App\Models\Extinguishers;
use App\Models\ExtinguisherRefill;
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
        $items = Extinguishers::with(['location'])->where('status', '!=', 'Retired')->paginate(100);
        return view('Admin.inspections.extinguishers', compact('items'));
    }

    public function ShowInspectionLogsTable($id)
    {
        $items = InspectionLogs::with(['user', 'extinguisher'])->where('extinguisher_id', $id)->latest()->paginate(100);
        $details = Extinguishers::find($id);

        return view('Admin.inspections.logstable', compact('items', 'details'));
    }
}
