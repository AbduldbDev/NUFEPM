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
use App\Models\Buildings;
use Illuminate\Support\Facades\Storage;

use Carbon\Carbon;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;


class ExtinguisherController extends Controller
{
    public function ShowActiveExtinguishers()
    {
        $items = Buildings::withCount([
            'locations as extinguisher_count' => function ($q) {
                $q->whereHas('extinguishers', function ($qq) {
                    $qq->where('status', '!=', 'Retired');
                });
            }
        ])->get();

        $url = 'Extinguisher/Active/';
        $type = "Active Extinguishers";
        $total = Extinguishers::where('status', '!=', 'Retired')->count();
        return view('Admin.SubMenu.BuildingsMenu', compact('items', 'url', 'type', 'total'));
    }

    public function ShowActiveTypeExtinguishers($type)
    {

        $base = Extinguishers::with(['location', 'user'])
            ->where('status', '!=', 'Retired');

        if ($type !== 'all') {
            $base->whereHas('location', function ($q) use ($type) {
                $q->where('building', $type);
            });
        }

        $items = (clone $base)->orderBy('id', 'desc')->paginate(100);

        $totalExtinguishers = (clone $base)->where('category', 'Extinguisher')->count();
        $totalFireHose = (clone $base)->where('category', 'Fire_Hose')->count();


        $nearExpirationQuery = (clone $base)->whereDate('life_span', '<=', now()->addDays(30));
        $nearExpiration = $nearExpirationQuery->count();
        $nearestExpirationDate = $nearExpirationQuery->orderBy('life_span', 'asc')->value('life_span');

        $nearInspectionQuery = (clone $base)->whereDate('next_maintenance', '<=', now()->addDays(30));
        $nearInspection = $nearInspectionQuery->count();
        $nearestInspectionDate = $nearInspectionQuery->orderBy('next_maintenance', 'asc')->value('next_maintenance');

        return view('Admin.extinguisher.table', compact(
            'items',
            'type',
            'totalExtinguishers',
            'nearExpiration',
            'nearestExpirationDate',
            'nearInspection',
            'nearestInspectionDate',
            'totalFireHose'
        ));
    }



    public function ShowRetiredExtinguishers()
    {
        $items = Buildings::withCount([
            'locations as extinguisher_count' => function ($q) {
                $q->whereHas('extinguishers', function ($qq) {
                    $qq->where('status', 'Retired');
                });
            }
        ])->get();

        $url = 'Extinguisher/Retired/';
        $type = "Retired Extinguishers";
        $total = Extinguishers::where('status', 'Retired')->count();
        return view('Admin.SubMenu.BuildingsMenu', compact('items', 'url', 'type', 'total'));
    }

    public function ShowRetiredTypeExtinguishers($type)
    {
        $base = Extinguishers::with(['location', 'user'])
            ->where('status', '!=', 'Retired');

        if ($type !== 'all') {
            $base->whereHas('location', function ($q) use ($type) {
                $q->where('building', $type);
            });
        }

        $items = (clone $base)->orderBy('id', 'desc')->paginate(100);

        $totalExtinguishers = (clone $base)->where('category', 'Extinguisher')->count();
        $totalFireHose = (clone $base)->where('category', 'Fire_Hose')->count();


        $nearExpirationQuery = (clone $base)->whereDate('life_span', '<=', now()->addDays(30));
        $nearExpiration = $nearExpirationQuery->count();
        $nearestExpirationDate = $nearExpirationQuery->orderBy('life_span', 'asc')->value('life_span');

        $nearInspectionQuery = (clone $base)->whereDate('next_maintenance', '<=', now()->addDays(30));
        $nearInspection = $nearInspectionQuery->count();
        $nearestInspectionDate = $nearInspectionQuery->orderBy('next_maintenance', 'asc')->value('next_maintenance');

        return view('Admin.extinguisher.retired', compact(
            'items',
            'type',
            'totalExtinguishers',
            'totalFireHose'
        ));
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
                'next_maintenance'  => now()->addDays(30),
                'life_span' => $request->life_span,
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
            'life_span' => 'required|numeric',

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




            $extinguisher =  Extinguishers::create([
                'created_by' => Auth::user()->id,
                'extinguisher_id'   => $extinguisherId,
                'serial_number'     => $request->serial_number,
                'category'          => $request->category,
                'type'              => $request->type,
                'capacity'          => $request->capacity,
                'location_id'       => $request->loc_id,
                'installation_date' => $request->installation_date,
                'last_maintenance'  => $request->installation_date,
                'next_maintenance'  => now()->addDays(30),
                'life_span' => now()->addMonths((int) $request->life_span),
                'qr_code_path'      => 'QRcodes/' . $filename,
            ]);

            $questions = InspectionQuestions::where('type', $extinguisher->category)->get();


            foreach ($questions as $question) {
                QuestionAssigned::create([
                    'extinguisher_id' => $extinguisher->id,
                    'question_id'     => $question->id,
                    'assigned_by'  => Auth::user()->id,
                ]);
            }


            return redirect()->route('admin.ShowActiveExtinguishers')->with('success', 'Extinguisher added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('errors',  $e->getMessage());
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
        $floor    = $request->get('floor');
        $room     = $request->get('room');

        $query = ExtinguisherLocations::query();

        if ($building) {
            $query->where('building', $building);
        }

        if ($floor) {
            $query->where('floor', $floor);
        }

        if ($room) {
            $query->where('room', $room);
        }

        $locations = $query->get();

        return response()->json([
            'floors' => $building && !$floor
                ? ExtinguisherLocations::where('building', $building)
                ->pluck('floor')->filter()->unique()->values()
                : [],

            'rooms' => $building && $floor && !$room
                ? ExtinguisherLocations::where('building', $building)
                ->where('floor', $floor)
                ->pluck('room')->filter()->unique()->values()
                : [],

            'spots' => $building && $floor && $room
                ? ExtinguisherLocations::where('building', $building)
                ->where('floor', $floor)
                ->where('room', $room)
                ->pluck('spot')->filter()->unique()->values()
                : [],
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
        $assignedQuestion = QuestionAssigned::with('question')->where('extinguisher_id', $id)->get();

        return view('Admin.extinguisher.details', compact('details', 'buildings',  'assignedQuestion'));
    }
}
