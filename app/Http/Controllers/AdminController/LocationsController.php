<?php

namespace App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Buildings;
use Illuminate\Http\Request;
use App\Models\ExtinguisherLocations;

class LocationsController extends Controller
{
    public function ShowLocations()
    {
        $items = Buildings::get();

        return view('Admin.SubMenu.Buildings', compact('items'));
    }

    public function ShowAddLocationBuilding($building)
    {
        $items = ExtinguisherLocations::where('building', $building)->with(['user'])
            ->orderBy('building', 'asc')
            ->orderBy('floor', 'asc')
            ->orderBy('room', 'asc')
            ->orderBy('spot', 'asc')
            ->paginate(100);

        return view('Admin.locations.alllocations', compact('items', 'building'));
    }

    public function SubmitNewLocation(Request $request)
    {
        $request->validate([
            'building' => 'required|string',
            'floor' => 'nullable|string',
            'room' => 'nullable|string',
            'spot' => 'nullable|string',
        ]);
        try {

            ExtinguisherLocations::create([
                'created_by' => Auth::user()->id,
                'building' => $request->building,
                'floor' => $request->floor,
                'room' => $request->room,
                'spot' => $request->spot,

            ]);

            return redirect()->back()->with('success', 'Location Added Successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to Add Location. Please try again.');
        }
    }

    public function UpdateLocation(Request $request)
    {
        try {
            ExtinguisherLocations::where('id', $request->id)->update([
                'building' => $request->building,
                'floor' => $request->floor,
                'room' => $request->room,
                'spot' => $request->spot,

            ]);
            return redirect()->back()->with('success', 'Location Edited Successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed To Edit Location. Please Try Again.');
        }
    }

    public function DeleteLocation(Request $request)
    {
        $location = ExtinguisherLocations::findOrFail($request->id);
        $location->delete();
        return redirect()->back()->with('success', 'Location deleted successfully.');
    }
}
