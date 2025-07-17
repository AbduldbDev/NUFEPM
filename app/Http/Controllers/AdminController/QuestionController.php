<?php

namespace App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InspectionQuestions;
use App\Models\QuestionAssigned;


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
            'fail' => 'required',
            'question' => 'required',
        ]);
        try {
            InspectionQuestions::create([
                'created_by' => Auth::user()->id,
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
        try {
            InspectionQuestions::where('id', $request->id)->update([
                'maintenance_interval'  => $request->interval,
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
        $request->validate([
            'question_ids' => 'array'
        ]);

        $existingAssignments = QuestionAssigned::where('extinguisher_id', $request->id)->get();
        $assignedByMap = $existingAssignments->pluck('assigned_by', 'question_id')->toArray();

        QuestionAssigned::where('extinguisher_id', $request->id)->delete();

        if ($request->has('question_ids')) {
            foreach ($request->question_ids as $question_id) {
                $assignedBy = $assignedByMap[$question_id] ?? Auth::user()->id;

                QuestionAssigned::create([
                    'extinguisher_id' => $request->id,
                    'question_id' => $question_id,
                    'assigned_by' => $assignedBy,
                ]);
            }
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
