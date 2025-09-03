<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Equipment;
use App\Models\ExtinguisherLocations;
use App\Models\InspectionCertificate;
use Illuminate\Support\Facades\Storage;

class DeviceController extends Controller
{
    public function ShowDevices()
    {
        $items = Equipment::with(['location'])->paginate(50);

        return view('Admin.Device.table', compact('items'));
    }

    public function ShowAddForm()
    {
        $buildings = ExtinguisherLocations::select('building')
            ->groupBy('building')
            ->pluck('building');
        return view('Admin.Device.add', compact('buildings'));
    }

    public function UpdateDevice(Request $request)
    {
        try {
            $validated = $request->validate([
                'type'              => 'required',
                'model'             => 'nullable|string|max:100',
                'serial_number'     => 'required|string|max:100',
                'loc_id'            => 'nullable|string|max:255',
                'installation_date' => 'nullable|date',
                'status'            => 'nullable',
            ]);

            $equipment = Equipment::findOrFail($request->id);
            $equipment->update($validated);



            return redirect()->back()->with('success', 'Device updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update device. Please try again.');
        }
    }

    public function StoreCertificate(Request $request)
    {
        $validated = $request->validate([
            'equipment_id'   => 'required|exists:equipment,id',
            'certificate_no' => 'nullable|string|max:255',
            'file_path'      => 'required|max:2048',
            'issue_date'     => 'nullable|date',
            'expiry_date'    => 'nullable|date|after_or_equal:issue_date',
        ]);

        $filename = ($request->certificate_no ?? uniqid('cert_'));
        $storedPath = $request->file('file_path')->storeAs(
            'Certificates',
            $filename,
            'public'
        );
        $validated['file_path'] = $storedPath;

        $certificate = InspectionCertificate::create($validated);

        return redirect()->back()->with('success', 'Certificate uploaded successfully!');
    }

    public function UpdateCertificate(Request $request)
    {
        $certificate = InspectionCertificate::findOrFail($request->id);

        $validated = $request->validate([
            'certificate_no' => 'nullable|string|max:255',
            'file_path'      => 'nullable|file|max:2048',
            'issue_date'     => 'nullable|date',
            'expiry_date'    => 'nullable|date|after_or_equal:issue_date',
        ]);

        if ($request->hasFile('file_path')) {
            if ($certificate->file_path && Storage::disk('public')->exists($certificate->file_path)) {
                Storage::disk('public')->delete($certificate->file_path);
            }

            $filename = ($request->certificate_no ?? uniqid('cert_'));
            $storedPath = $request->file('file_path')->storeAs(
                'Certificates',
                $filename,
                'public'
            );
            $validated['file_path'] = $storedPath;
        }

        $certificate->update($validated);

        return redirect()->back()->with('success', 'Certificate updated successfully!');
    }

    public function DeleteDevice(Request $request)
    {
        $device = Equipment::findOrFail($request->id);
        $device->delete();
        return redirect()->back()->with('success', 'Device deleted successfully.');
    }

    public function ShowDeviceDetails($id)
    {
        $details = Equipment::findOrFail($id);
        $buildings = ExtinguisherLocations::select('building')->groupBy('building')->pluck('building');
        $items = InspectionCertificate::latest()->paginate(50);
        return view('Admin.Device.details', compact('details', 'buildings', 'items'));
    }
}
