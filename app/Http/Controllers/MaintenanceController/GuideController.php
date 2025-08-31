<?php

namespace App\Http\Controllers\MaintenanceController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GuideController extends Controller
{
    public function ShowGuide()
    {
        return view('Maintenance.Guide.guide');
    }
}
