<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\InspectionExport;
use App\Exports\NearExpiration;
use App\Exports\NotInspected;
use App\Exports\RefillLogs;
use App\Exports\CertificateNearExpirationExport;
use App\Exports\AllEquipmentCertificatesExport;
use App\Exports\CompletedSOSReportsExport;
use App\Exports\ExpiredExtinguishersExport;
use App\Models\Extinguishers;
use App\Models\InspectionLogs;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\ExtinguisherRefill;

class ExportController extends Controller
{
    public function ShowExportMenu()
    {
        return view('Admin.SubMenu.ExportLogs',);
        return view('Admin.export.exportlogs',);
    }

    public function ShowExportExtinguisher()
    {
        return view('Admin.export.extinguisher',);
    }

    public function ShowExportRefill()
    {
        return view('Admin.export.refill',);
    }

    public function ShowExportIncident()
    {
        return view('Admin.export.sosreport',);
    }

    public function ShowExportDevices()
    {
        return view('Admin.export.devices',);
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
    public function ExpiredExtinguishers()
    {
        $expired = Extinguishers::with(['location'])
            ->get();

        return Excel::download(new ExpiredExtinguishersExport($expired), 'expired_extinguishers.xlsx');
    }

    public function notinspect(Request $request)
    {
        $data = Extinguishers::where('next_maintenance', '<', now())->where('status', "!=", 'Retired')->get();

        return Excel::download(new NotInspected($data), 'no_inspections.xlsx');
    }


    public function exportRefillLogs(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
        ]);
        $refillLogs = ExtinguisherRefill::with(['user', 'extinguisher.location'])->whereBetween('created_at', [$request->start_date, $request->end_date])->get();
        return Excel::download(new RefillLogs($refillLogs), 'refill_logs.xlsx');
    }

    public function exportNearExpiryCertificates(Request $request)
    {
        $validated = $request->validate([
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
        ]);

        return Excel::download(
            new CertificateNearExpirationExport($validated['start_date'], $validated['end_date']),
            'near_expiration_certificates.xlsx'
        );
    }


    public function exportAllEquipment()
    {
        return Excel::download(new AllEquipmentCertificatesExport, 'all_equipment_certificates.xlsx');
    }

    public function exportCompletedSOS(Request $request)
    {
        $validated = $request->validate([
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
        ]);

        return Excel::download(new CompletedSOSReportsExport($validated['start_date'], $validated['end_date']), 'completed_sos_reports.xlsx');
    }
}
