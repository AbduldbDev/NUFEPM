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
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
            ]);

            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('sos_reports', 'public');
            }

            $report = SOSReport::create([
                'user_id' => Auth::id(),
                'location' => $request->location,
                'description' => $request->description,
                'image' => $imagePath ? '/storage/' . $imagePath : null,
            ]);

            $admins = User::whereIn('type', ['admin', 'engineer'])->get();
            foreach ($admins as $admin) {
                Notification::create([
                    'user_id' => $admin->id,
                    'notifiable_type' => 'sos',
                    'notifiable_id' => $report->id,
                    'type' => 'sos',
                    'message' => "SOS Report: {$request->description} at {$request->location}",
                ]);
            }


            return redirect()->back()->with('success', 'SOS Report submitted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error', $e->getMessage()]);
        }
    }


    public function ShowReport(SOSReport $report)
    {
        return view('admin.sos.show', compact('report'));
    }
}
