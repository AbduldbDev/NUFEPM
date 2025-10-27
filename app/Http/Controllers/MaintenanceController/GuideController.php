<?php

namespace App\Http\Controllers\MaintenanceController;

use App\Http\Controllers\Controller;
use App\Models\EmergencyHotline;
use Illuminate\Http\Request;
use App\Models\InspectionGuideContent;

class GuideController extends Controller
{
    public function ShowGuide()
    {

        // $contents = InspectionGuideContent::orderBy('step_number', 'asc')->get();
        // return view('Maintenance.Guide.guide', compact('contents'));
        return view('Maintenance.SubMenu.Inspections');
    }

    public function ShowInspectionType($type)
    {
        $contents = InspectionGuideContent::where('type', $type)->orderBy('step_number', 'asc')->get();
        return view('Maintenance.Guide.guide', compact('contents', 'type'));
    }


    public function ShowHotlines()
    {
        $contents = EmergencyHotline::all()->groupBy('location');
        return view('Maintenance.Guide.hotlines', compact('contents'));
    }
}
