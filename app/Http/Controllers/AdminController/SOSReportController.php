<?php

namespace App\Http\Controllers\AdminController;

use App\Models\SOSReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;

class SOSReportController extends Controller
{
    public function ShowAll()
    {
        $items = SOSReport::with('user')->latest()->paginate(100);
        return view('Admin.SOS.table', compact('items'));
    }

    public function ShowDetails($id)
    {
        $item = SOSReport::with('user')->findOrFail($id);
        return view('Admin.SOS.details', compact('item'));
    }

    public function UpdateSOS(Request $request)
    {
        $item = SOSReport::findOrFail($request->id);
        $item->update([
            'status' => $request->status,
        ]);

        return redirect()->route('admin.ShowSOSReports')->with('success', 'Incident Updated successfully.');
    }

    public function ShowCreateForm()
    {
        return view('Maintenance.SOS.sendsos');
    }

    public function StoreReport(Request $request)
    {

        try {
            $request->validate([
                'location' => 'required|string|max:255',
                'description' => 'required|string',
                'date_time' => 'required|max:255',
                'image.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:25600'
            ]);

            $imagePaths = [];

            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $image) {
                    $path = $image->store('sos_images', 'public');
                    $imagePaths[] = '/storage/' . $path;
                }
            }

            $report = SOSReport::create([
                'user_id' => Auth::id(),
                'location' => $request->location,
                'description' => $request->description,
                'date_time' => $request->date_time,
                'image'       => json_encode($imagePaths),
            ]);

            $admins = User::whereIn('type', ['admin', 'engineer'])->get();
            foreach ($admins as $admin) {
                Notification::create([
                    'user_id' => $admin->id,
                    'notifiable_type' => 'Incident Report',
                    'notifiable_id' => $report->id,
                    'type' => 'sos',
                    'message' => "Incident Report: {$request->description} at {$request->location}",
                ]);
            }

            return redirect()->back()->with('success', 'Incident Report submitted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error', $e->getMessage()]);
        }
    }


    public function ShowReport(SOSReport $report)
    {
        return view('admin.sos.show', compact('report'));
    }
}
