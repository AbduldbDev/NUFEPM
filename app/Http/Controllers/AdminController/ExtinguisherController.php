<?php

namespace App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Extinguishers;
use App\Models\ExtinguishersTypes;
use App\Models\ExtinguisherLocations;
use App\Models\InspectionQuestions;
use App\Models\QuestionAssigned;
use Illuminate\Support\Facades\Storage;

use Carbon\Carbon;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;


class ExtinguisherController extends Controller
{
    public function ShowActiveExtinguishers()
    {
        $items = Extinguishers::with(['location',  'user'])->where('status', '!=', 'Retired')->paginate(50);
        return view('Admin.extinguisher.table', compact('items'));
    }

    public function ShowRetiredExtinguishers()
    {
        $items = Extinguishers::with(['location', 'user'])->where('status', 'Retired')->paginate(50);
        return view('Admin.extinguisher.table', compact('items'));
    }

    public function ShowAddTankForm()
    {
        $tanks = Extinguishers::with(['location'])->get();

        $buildings = ExtinguisherLocations::select('building')
            ->groupBy('building')
            ->pluck('building');
        return view('Admin.extinguisher.add', compact('tanks', 'buildings'));
    }


    public function UpdateExtinguishers(Request $request)
    {
        $request->validate([
            'serial_number' => 'required|string',
            'category' => 'required|string',
            'type' => 'required',
            'capacity' => 'required|string',
            'location_id' => 'required|string',
            'installation_date' => 'nullable|date',
        ]);

        try {
            Extinguishers::where('id', $request->id)->update([
                'serial_number' => $request->serial_number,
                'category'  => $request->category,
                'type'  => $request->type,
                'capacity' => $request->capacity,
                'location_id' => $request->location_id,
                'installation_date' => $request->installation_date,
                'status' => $request->status,
            ]);
            return redirect()->back()->with('success', 'Extinguisher updated successfully.');
        } catch (\Exception $e) {
            Log::error('AddNewTank failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to add extinguisher. Please try again.');
        }
    }

    public function AddNewTank(Request $request)
    {
        $request->validate([
            'serial_number' => 'required|string',
            'type' => 'required',
            'category' => 'required|string',
            'capacity' => 'required|string',
            'loc_id'  => 'required|string',
            'installation_date' => 'nullable|date',

        ]);

        try {
            do {
                $extinguisherId = 'EX' . strtoupper(Str::random(5));
            } while (Extinguishers::where('extinguisher_id', $extinguisherId)->exists());


            $qrValue = $extinguisherId;
            $qrCode = new QrCode($qrValue);
            $writer = new PngWriter();

            $filename = $extinguisherId . '_qrcode.png';
            $path = public_path('QRcodes/' . $filename);

            if (!file_exists(public_path('QRcodes'))) {
                mkdir(public_path('QRcodes'), 0755, true);
            }
            $result = $writer->write($qrCode);
            $binaryData = $result->getString();

            Storage::disk('public')->put("QRcodes/{$filename}", $binaryData);

            Extinguishers::create([
                'created_by' => Auth::user()->id,
                'extinguisher_id'   => $extinguisherId,
                'serial_number'     => $request->serial_number,
                'category'  => $request->category,
                'type'              => $request->type,
                'capacity'          => $request->capacity,
                'location_id'          => $request->loc_id,
                'installation_date' => $request->installation_date,
                'last_maintenance' => $request->installation_date,
                'next_maintenance' => now()->addDays(30),
                'qr_code_path'      => 'QRcodes/' . $filename,
            ]);

            return redirect()->route('admin.ShowActiveExtinguishers')->with('success', 'Extinguisher added successfully!');
        } catch (\Exception $e) {
            Log::error('AddNewTank failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to add extinguisher. Please try again.');
        }
    }

    public function DeleteExtinguisher(Request $request)
    {
        $extinguisher = Extinguishers::findOrFail($request->id);
        $extinguisher->delete();
        return redirect()->back()->with('success', 'Extinguisher deleted successfully.');
    }

    public function GetLocations(Request $request)
    {
        $building = $request->get('building');
        $floor = $request->get('floor');
        $room = $request->get('room');

        $query = ExtinguisherLocations::query();

        if ($building) {
            $query->where('building', $building);
        }

        if ($floor !== null) {
            $query->where('floor', $floor);
        }

        if ($room !== null) {
            $query->where('room', $room);
        }

        $locations = $query->get();

        $allInBuilding = ExtinguisherLocations::where('building', $building)->get();

        return response()->json([
            'floors' => $floor === null ? $allInBuilding->pluck('floor')->filter()->unique()->values() : [],
            'rooms' => $room === null ? $allInBuilding->pluck('room')->filter()->unique()->values() : [],
            'spots' => $allInBuilding->pluck('spot')->filter()->unique()->values(),
        ]);
    }

    public function GetEditLocations(Request $request)
    {
        $building = $request->get('building');
        $floor = $request->get('floor');
        $room = $request->get('room');

        $floors = ExtinguisherLocations::where('building', $building)
            ->pluck('floor')->filter()->unique()->values();

        $rooms = ExtinguisherLocations::where('building', $building)
            ->when($floor, fn($q) => $q->where('floor', $floor))
            ->pluck('room')->filter()->unique()->values();

        $spots = ExtinguisherLocations::where('building', $building)
            ->when($floor, fn($q) => $q->where('floor', $floor))
            ->when($room, fn($q) => $q->where('room', $room))
            ->orWhere(function ($q) use ($building) {
                $q->where('building', $building)
                    ->whereNull('floor')
                    ->whereNull('room');
            })
            ->pluck('spot')->filter()->unique()->values();

        return response()->json([
            'floors' => $floors,
            'rooms' => $rooms,
            'spots' => $spots,
        ]);
    }

    public function GetLocationID(Request $request)
    {
        $query = ExtinguisherLocations::query();

        if ($request->building) {
            $query->where('building', $request->building);
        }

        if ($request->filled('floor')) {
            $query->where('floor', $request->floor);
        } else {
            $query->whereNull('floor');
        }

        if ($request->filled('room')) {
            $query->where('room', $request->room);
        } else {
            $query->whereNull('room');
        }

        if ($request->filled('spot')) {
            $query->where('spot', $request->spot);
        } else {
            $query->whereNull('spot');
        }

        $location = $query->first();

        return response()->json(['id' => $location->id ?? null]);
    }

    public function ShowLocationID($id)
    {
        $location = ExtinguisherLocations::findOrFail($id);

        return response()->json([
            'building' => $location->building,
            'floor' => $location->floor,
            'room' => $location->room,
            'spot' => $location->spot,
        ]);
    }

    public function ShowExtinguishersDetails($id)
    {

        $details = Extinguishers::findOrFail($id);
        $buildings = ExtinguisherLocations::select('building')->groupBy('building')->pluck('building');

        $allQuestions = InspectionQuestions::all();
        $assignedQuestionIds = QuestionAssigned::where('extinguisher_id', $id)->pluck('question_id')->toArray();

        return view('Admin.extinguisher.details', compact('details', 'buildings',  'allQuestions', 'assignedQuestionIds'));
    }
}
