<?php

namespace App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Buildings;
use App\Models\ExtinguisherLocations;
use Illuminate\Http\Request;

class BuildingController extends Controller
{
    public function NewBuildingForm()
    {

        return view('Admin.locations.addbuilding');
    }

    public function SubmitNewBuilding(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'icon'          => 'required|string|max:255',
                'description'   => 'required|string',
            ]);

            Buildings::create($validated);
            ExtinguisherLocations::create([
                'created_by' => Auth::user()->id,
                'building' => $request->name,
            ]);

            return redirect()->route('admin.ShowLocations')->with('success', 'Building has been added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error', $e->getMessage()]);
        }
    }

    public function UpdateBuilding(Request $request)
    {
        try {
            $validated = $request->validate([
                'id'          => 'required|integer|exists:location_buildings,id',
                'name'        => 'required|string|max:255',
                'icon'        => 'required|string|max:255',
                'description' => 'required|string',
            ]);


            $building = Buildings::findOrFail($validated['id']);
            ExtinguisherLocations::where('building', $building->name)->update([
                'building' => $request->name
            ]);

            $building->update($validated);
            return redirect()->route('admin.ShowLocations')->with('success', 'Building updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function DeleteBuilding(Request $request)
    {
        $location = Buildings::findOrFail($request->id);
        if (!$location) {
            return redirect()->back()->with('error', 'Building not found!');
        }

        ExtinguisherLocations::where('building', $location->name)->delete();
        $location->delete();
        return redirect()->back()->with('success', 'Building Location deleted successfully.');
    }
}
