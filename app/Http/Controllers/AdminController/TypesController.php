<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Models\ExtinguishersTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TypesController extends Controller
{
    public function ShowTypes()
    {
        $items = ExtinguishersTypes::with(['user'])->get();
        return view('Admin.types.alltypes', compact('items'));
    }
    public function SubmitNewType(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'color' => 'required|string',
        ]);
        try {

            ExtinguishersTypes::create([
                'created_by' => Auth::user()->id,
                'name'  => $request->name,
                'color' => $request->color,

            ]);

            return redirect()->back()->with('success', 'Extinguisher type added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add type. Please try again.');
        }
    }

    public function UpdateType(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'color' => 'required|string',
        ]);
        try {

            ExtinguishersTypes::where('id', $request->id)->update([
                'name'  => $request->name,
                'color' => $request->color,
            ]);

            return redirect()->back()->with('success', 'Extinguisher type added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add type. Please try again.');
        }
    }

    public function DeleteTypes(Request $request)
    {
        $types = ExtinguishersTypes::findOrFail($request->id);
        $types->delete();
        return redirect()->back()->with('success', 'Extinguisher type deleted successfully.');
    }
}
