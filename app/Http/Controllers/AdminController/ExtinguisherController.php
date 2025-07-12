<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Extinguishers;
use App\Models\ExtinguishersTypes;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;


class ExtinguisherController extends Controller
{
    public function ShowAddTankForm()
    {
        $tanks = Extinguishers::get();
        $types = ExtinguishersTypes::get();
        return view('Admin.extinguisher.add', compact('tanks', 'types'));
    }

    public function AddNewTank(Request $request)
    {
        $request->validate([
            'serial_number' => 'required|string',
            'type' => 'required|string',
            'capacity' => 'required|string',
            'location' => 'required|string',
            'installation_date' => 'nullable|date',
            'status' => 'required|string',
        ]);

        try {
            do {
                $extinguisherId = 'EX' . strtoupper(Str::random(5));
            } while (Extinguishers::where('extinguisher_id', $extinguisherId)->exists());


            $qrValue = env('APP_URL') . '/FireExtinguisher/' . $extinguisherId;
            $qrCode = new QrCode($qrValue);
            $writer = new PngWriter();

            $filename = $extinguisherId . '_qrcode.png';
            $path = public_path('QRcodes/' . $filename);

            if (!file_exists(public_path('QRcodes'))) {
                mkdir(public_path('QRcodes'), 0755, true);
            }
            $writer->write($qrCode)->saveToFile($path);


            Extinguishers::create([
                'extinguisher_id'   => $extinguisherId,
                'serial_number'     => $request->serial_number,
                'type'              => $request->type,
                'capacity'          => $request->capacity,
                'location'          => $request->location,
                'installation_date' => $request->installation_date,
                'status'            => $request->status,
                'qr_code_path'      => 'QRcodes/' . $filename,
            ]);
            return redirect()->back()->with('success', 'Extinguisher added successfully!');
        } catch (\Exception $e) {
            Log::error('AddNewTank failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to add extinguisher. Please try again.');
        }
    }
}
