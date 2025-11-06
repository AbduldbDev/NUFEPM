<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\InspectionExport;
use App\Exports\NearExpiration;
use App\Exports\NotInspected;
use App\Models\Extinguishers;
use App\Models\InspectionLogs;
use Maatwebsite\Excel\Facades\Excel;


class ExportController extends Controller
{
    public function ShowExportForm()
    {
        return view('Admin.SubMenu.ExportLogs',);
        // return view('Admin.export.exportlogs',);
    }

    public function export(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
        ]);
        $data = InspectionLogs::with(['answers.questions', 'extinguisher.location'])
            ->whereBetween('inspected_at', [$request->start_date, $request->end_date])
            ->get();

        return Excel::download(new InspectionExport($data), 'inspection.xlsx');
    }

    public function expiration(Request $request)
    {
        $today = now();
        $limit = now()->addDays(30);
        $data = Extinguishers::whereBetween('life_span', [$today, $limit])->where('status', "!=", 'Retired')->get();

        return Excel::download(new NearExpiration($data), 'near_expiration.xlsx');
    }

    public function notinspect(Request $request)
    {
        $data = Extinguishers::where('next_maintenance', '<', now())->where('status', "!=", 'Retired')->get();

        return Excel::download(new NotInspected($data), 'no_inspections.xlsx');
    }
}
