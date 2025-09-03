<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Models\EmergencyPlans;
use Illuminate\Http\Request;

class EmergencyPlanController extends Controller
{

    public function ManageEmergencyPlans()
    {
        $items = EmergencyPlans::orderBy('building', 'asc')->paginate(100);
        return view('Admin.EmergencyPlan.table', compact('items'));
    }

    public function ShowEmergencyPlansMenu()
    {
        return view('Maintenance.EmergencyPlan.EmergencyPlan');
    }

    public function ShowFloorPlans($building)
    {
        $items = EmergencyPlans::where('building', $building)->paginate(100);
        return view('Maintenance.EmergencyPlan.table', compact('items', 'building'));
    }

    public function UpdateEmergencyPlan(Request $request)
    {
        try {
            $request->validate([
                'pdf'      => 'nullable|mimes:pdf|max:10000',
            ]);
            $plan = EmergencyPlans::findOrFail($request->id);

            $pdfPath = $plan->pdf;

            $pdfPath = null;
            if ($request->hasFile('pdf')) {
                $path = $request->file('pdf')->store('PDF', 'public');
                $pdfPath = '/storage/' . $path;
            }

            $plan->update([
                'pdf'      => $pdfPath,
            ]);

            return redirect()->back()->with('success', 'Emergency Plan updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error', $e->getMessage()]);
        }
    }
}
