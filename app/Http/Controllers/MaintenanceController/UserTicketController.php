<?php

namespace App\Http\Controllers\MaintenanceController;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\User;

class UserTicketController extends Controller
{
    public function ShowAll()
    {
        $items = Ticket::with(['creator', 'assignee'])->where('assigned_to', Auth::id())->latest()->paginate(100);
        return view('Maintenance.Tickets.table', compact('items'));
    }
    public function  ShowDetails($id)
    {
        $detail = Ticket::with(['creator', 'assignee'])->where('id', $id)->first();
        $users = User::all();
        return view('Maintenance.Tickets.details', compact('detail', 'users'));
    }


    public function UpdateTicketUser(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|exists:tickets,id',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:25600'
            ]);

            $imagePaths = [];

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $image->store('Tickets', 'public');
                    $imagePaths[] = '/storage/' . $path;
                }
            }

            $ticket = Ticket::findOrFail($request->id);
            $ticket->update([
                'remarks'       => $request->remarks,
                'images'        => json_encode($imagePaths),
                'status'        => 'completed',
                'completed_at'  => now(),
            ]);

            return redirect()->route('admin.ShowAllTickets')->with('success', 'Ticket completed successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Update failed: ' . $e->getMessage());
        }
    }
}
