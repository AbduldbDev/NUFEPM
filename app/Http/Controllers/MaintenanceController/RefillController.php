<?php

namespace App\Http\Controllers\MaintenanceController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExtinguisherRefill;
use App\Models\Extinguishers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\Ticket;
use Illuminate\Support\Str;

class RefillController extends Controller
{

    public function ShowRefillConfirmation()
    {
        return view('Maintenance.confirmation.refill');
    }

    public function ShowRefillForm($id)
    {
        $details = Extinguishers::find($id);

        if (!$details) {
            return redirect()->back()->with('error', "Cannot Find Extinguisher.");
        }

        return view('Maintenance.refill.startrefill', compact('details'));
    }
    // public function ShowALlRefills()
    // {
    //     $details = ExtinguisherRefill::paginate($id);

    //     if (!$details) {
    //         return redirect()->back()->with('error', "Cannot Find Extinguisher.");
    //     }

    //     return view('Maintenance.refill.startrefill', compact('details'));
    // }


    public function SubmitRefill(Request $request)
    {
        $request->validate([
            'remarks' => 'required|string',
        ]);

        try {
            ExtinguisherRefill::create([
                'extinguisher_id' => $request->id,
                'refill_by' => Auth::user()->id,
                'refill_date' => Carbon::now(),
                'remarks'  => $request->remarks,
            ]);
            do {

                $ticketID = 'TIX' . strtoupper(Str::random(5));
            } while (Ticket::where('ticket_id', $ticketID)->exists());

            if ($request->remarks !== 'good') {
                Ticket::create([
                    'ticket_id' => $ticketID,
                    'created_by' => Auth::id(),
                    'description' => "During Refill of extinguisher #{$request->id}, the remark was ({$request->remarks}), inspected by " . Auth::user()->lname . ", " . Auth::user()->fname,

                ]);
            }
            return redirect()->route('maintenance.ShowRefillConfirmation')->with('success', 'Refill log saved successfully.');
        } catch (\Exception $e) {
            Log::error('AddNewTank failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to save refill log. Please try again.');
        }
    }
}
