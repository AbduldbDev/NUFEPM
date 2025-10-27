<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Models\InspectionGuideContent;
use Illuminate\Http\Request;

class InspectionGuideController extends Controller
{
    public function ShowGuideTable()
    {
        
        return view('Admin.SubMenu.Inspections');
    }

    public function ShowInspectionType($type)
    {
        $items = InspectionGuideContent::where('type', $type)->orderBy('step_number', 'asc')->paginate(100);
        return view('Admin.Guide.table', compact('items', 'type'));
    }

    public function AddNewGuide(Request $request)
    {
        try {
            $request->validate([
                'type' => 'required|string',
                'title'   => 'required|string|max:255',
                'content' => 'required|string',
                'image'   => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $lastStep = InspectionGuideContent::where('type', $request->type)->max('step_number');
            $nextStep = $lastStep ? $lastStep + 1 : 1;
            $imagePath = null;
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('inspection_images', 'public');
                $imagePath = '/storage/' . $path;
            }


            InspectionGuideContent::create([
                'type'        => $request->type,
                'title'       => $request->title,
                'content'     => $request->content,
                'image_path'  => $imagePath,
                'step_number' => $nextStep,
            ]);

            return redirect()->back()->with('success', 'New inspection step added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error', $e->getMessage()]);
        }
    }

    public function UpdateGuide(Request $request)
    {
        try {
            $request->validate([
                'type' => 'required|string',
                'title'   => 'required|string|max:255',
                'content' => 'required|string',
                'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $guide = InspectionGuideContent::findOrFail($request->id);

            if ($request->hasFile('image')) {
                if ($guide->image_path && file_exists(public_path($guide->image_path))) {
                    unlink(public_path($guide->image_path));
                }

                $path = $request->file('image')->store('inspection_images', 'public');
                $guide->image_path = '/storage/' . $path;
            }

            $guide->title   = $request->title;
            $guide->type   = $request->type;
            $guide->content = $request->content;
            $guide->save();

            return redirect()->back()->with('success', 'Inspection guide updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error', $e->getMessage()]);
        }
    }


    public function DeleteGuide(Request $request)
    {
        try {
            $questions = InspectionGuideContent::findOrFail($request->id);
            $questions->delete();
            return redirect()->back()->with('success', 'Guide deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error', $e->getMessage()]);
        }
    }
}
