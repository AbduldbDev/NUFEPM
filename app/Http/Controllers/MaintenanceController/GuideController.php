<?php

namespace App\Http\Controllers\MaintenanceController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InspectionGuideContent;

class GuideController extends Controller
{
    public function ShowGuide()
    {
        $contents = InspectionGuideContent::orderBy('step_number', 'asc')->get();
        return view('Maintenance.Guide.guide', compact('contents'));
    }
}
