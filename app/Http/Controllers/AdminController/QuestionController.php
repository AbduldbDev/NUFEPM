<?php

namespace App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InspectionQuestions;
use App\Models\QuestionAssigned;
use App\Models\Extinguishers;

class QuestionController extends Controller
{
    public function ShowAllQuestions()
    {
        $items = InspectionQuestions::with(['user'])->paginate(50);
        return view('Admin.questions.allquestions', compact('items'));
    }


    public function SubmitNewQuestion(Request $request)
    {
        $request->validate([
            'interval' => 'required|string',
            'type' => 'required|string',
            'fail' => 'required',
            'question' => 'required',
        ]);
        try {
            InspectionQuestions::create([
                'created_by' => Auth::user()->id,
                'type' => $request->type,
                'maintenance_interval'  => $request->interval,
                'fail_reschedule_days' => $request->fail,
                'question' => $request->question,

            ]);

            return redirect()->back()->with('success', 'Maintenance Question added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add Question. Please try again.');
        }
    }

    public function UpdateQuestion(Request $request)
    {
        $request->validate([
            'interval' => 'required|string',
            'type' => 'required|string',
            'fail' => 'required',
            'question' => 'required',
        ]);

        try {
            InspectionQuestions::where('id', $request->id)->update([
                'maintenance_interval'  => $request->interval,
                'type' => $request->type,
                'fail_reschedule_days' => $request->fail,
                'question' => $request->question,

            ]);

            return redirect()->back()->with('success', 'Maintenance Question edited successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to edit Question. Please try again.');
        }
    }


    public function AssignInspectionQuestion(Request $request)
    {
        $extingusiher = Extinguishers::findOrFail($request->id);
        $questions = InspectionQuestions::where('type', $extingusiher->category)->get();

        foreach ($questions as $question) {
            QuestionAssigned::create([
                'extinguisher_id' => $extingusiher->id,
                'question_id'     => $question->id,
                'assigned_by'  => Auth::user()->id,
            ]);
        }


        return back()->with('success', 'Questions updated successfully!');
    }


    public function DeleteQuestions(Request $request)
    {
        $questions = InspectionQuestions::findOrFail($request->id);
        $questions->delete();
        return redirect()->back()->with('success', 'Question deleted successfully.');
    }
}
