<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmergencyHotline;

class EmergencyHotlinesController extends Controller
{
    public function ManageEmergencyHotlines()
    {
        $items = EmergencyHotline::orderBy('location', 'asc')->paginate(100);
        return view('Admin.EmergencyHotlines.table', compact('items'));
    }

    public function UpdateHotline(Request $request)
    {
        try {
            $request->validate([
                'location' => 'required|string',
                'label' => 'required|string',
                'number' => 'required|string',
            ]);

            EmergencyHotline::where('id', $request->id)->update([
                'location' => $request->location,
                'label' => $request->label,
                'number' => $request->number,
            ]);
            return redirect()->back()->with('success', 'Emergency hotline updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error', $e->getMessage()]);
        }
    }
    
    public function CreateHotline(Request $request)
    {
        try {
            $request->validate([
                'location' => 'required|string',
                'label' => 'required|string',
                'number' => 'required|string',
            ]);

            EmergencyHotline::create([
                'location' => $request->location,
                'label' => $request->label,
                'number' => $request->number,
            ]);
            return redirect()->back()->with('success', 'Emergency hotline created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error', $e->getMessage()]);
        }
    }

    public function DeleteEmergencyHotline(Request $request)
    {
        try {
            $hotline = EmergencyHotline::findOrFail($request->id);
            $hotline->delete();
            return redirect()->back()->with('success', 'Emergency hotline deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error', $e->getMessage()]);
        }
    }
}
