<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\InspectionExport;
use App\Models\InspectionLogs;
use Maatwebsite\Excel\Facades\Excel;


class ExportController extends Controller
{
    public function ShowExportForm()
    {
        return view('Admin.export.exportlogs',);
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
}
