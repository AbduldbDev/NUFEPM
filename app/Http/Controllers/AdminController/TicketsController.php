<?php

namespace App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class TicketsController extends Controller
{
    public function ShowAll()
    {
        $items = Ticket::with(['creator', 'assignee'])->latest()->paginate(100);
        return view('Admin.Tickets.table', compact('items'));
    }

    public function  AddNew()
    {
        $users = User::all();
        return view('Admin.Tickets.addnew', compact('users'));
    }

    public function  ShowDetails($id)
    {
        $detail = Ticket::with(['creator', 'assignee'])->where('id', $id)->first();
        $users = User::all();
        return view('Admin.Tickets.details', compact('detail', 'users'));
    }
    public function CreateTicket(Request $request)
    {
        $request->validate([
            'assignee_to'  => 'nullable|exists:users,id',
            'description'  => 'nullable|string|max:2000',
            'instructions' => 'nullable|string|max:2000',
        ]);

        do {
            $ticketID = 'TIX' . strtoupper(Str::random(5));
        } while (Ticket::where('ticket_id', $ticketID)->exists());

        $ticket = Ticket::create([
            'ticket_id'    => $ticketID,
            'created_by'   => Auth::id(),
            'assigned_to'  => $request->assignee_to,
            'description'  => $request->description,
            'instructions' => $request->instructions,
        ]);

        return redirect()->route('admin.ShowAllTickets')->with('success', 'New ticket created successfully!');
    }

    public function UpdateTicket(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|exists:tickets,id',
                'assignee_to' => 'nullable|exists:users,id',
                'description' => 'nullable|string',
                'instructions' => 'nullable|string',
                'submitted_at' => 'nullable|date',
                'status' => 'required|in:open,in_progress,completed',
            ]);

            $ticket = Ticket::findOrFail($request->id);

            $ticket->update([
                'assigned_to'   => $request->assignee_to,
                'description'   => $request->description,
                'instructions'  => $request->instructions,
                'status'        => $request->status,
                'created_at'    => $request->submitted_at ?? $ticket->created_at,
            ]);

            if ($request->status === 'completed' && !$ticket->completed_at) {
                $ticket->completed_at = now();
                $ticket->save();
            }

            return redirect()->back()->with('success', 'Ticket updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Update failed: ' . $e->getMessage());
        }
    }


    public function DeleteTicket(Request $request)
    {
        $Ticket = Ticket::findOrFail($request->id);
        $Ticket->delete();
        return redirect()->back()->with('success', 'Ticket deleted successfully.');
    }
}
