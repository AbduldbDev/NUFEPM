<?php

namespace App\Http\Controllers\MaintenanceController;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Extinguishers;
use App\Models\InspectionQuestions;
use App\Models\QuestionAssigned;
use App\Models\InspectionLogs;
use App\Models\InspectionAnswer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InspectionController extends Controller
{

    public function ShowConfirmation()
    {
        return view('Maintenance.Inspection.confirmation');
    }
    public function ShowScanner()
    {
        return view('Maintenance.Inspection.scanner');
    }

    public function ShowInspectionDetail($id)
    {
        $extinguisher = Extinguishers::with(['type', 'location'])->where('extinguisher_id', $id)->first();

        return view('Maintenance.Inspection.details', compact('extinguisher'));
    }


    public function StartInspection($id)
    {
        $extinguisher = Extinguishers::with(['type', 'location'])->where('extinguisher_id', $id)->first();
        $assigned = QuestionAssigned::where('extinguisher_id', $extinguisher->id)->get();

        $questions = $assigned->map(function ($qa) {
            return $qa->question;
        });

        return view('Maintenance.Inspection.questionaire', compact('extinguisher', 'questions'));
    }

    public function SubmitInspection(Request $request)
    {
        try {
            $validated = $request->validate([
                'answers' => 'required|array',
                'status' => 'required|string|in:good,undercharged,overcharged',
                'remarks' => 'required|string|max:1000',
            ]);

            $yesAnswers = [];
            $noAnswers = [];

            foreach ($validated['answers'] as $questionId => $answer) {
                if ($answer === 'yes') {
                    $yesAnswers[] = $questionId;
                } elseif ($answer === 'no') {
                    $noAnswers[] = $questionId;
                }
            }

            $nextDueDate = now();

            if (!empty($noAnswers)) {
                $minFailDays = InspectionQuestions::whereIn('id', $noAnswers)->min('fail_reschedule_days');
                $minYesInterval = InspectionQuestions::whereIn('id', $yesAnswers)->min('maintenance_interval');

                if ($minYesInterval && $minYesInterval < $minFailDays) {
                    $nextDueDate = now()->addDays($minYesInterval);
                } else {
                    $nextDueDate = now()->addDays($minFailDays);
                }
            } else {
                $minYesInterval = InspectionQuestions::whereIn('id', $yesAnswers)->min('maintenance_interval');
                if ($minYesInterval) {
                    $nextDueDate = now()->addDays($minYesInterval);
                }
            }


            $status = '';
            if ($request->status == 'undercharged') {
                $status = 'Undercharged';
            } elseif ($request->status == 'overcharged') {
                $status = 'Overcharged';
            } else {
                $status = 'Good';
            }

            Extinguishers::where('id', $request->id)->update([
                'next_maintenance' =>  $nextDueDate,
                'last_maintenance' =>  Carbon::now(),
                'status' => $status,
            ]);

            $inspectionLog = InspectionLogs::create([
                'extinguisher_id' => $request->id,
                'inspected_by' => Auth::id(),
                'inspected_at' => Carbon::now(),
                'next_due' => $nextDueDate,
                'time' => $request->time,
                'status' => $status,
                'remarks' => $validated['remarks'],
            ]);

            foreach ($validated['answers'] as $questionId => $answer) {
                InspectionAnswer::create([
                    'inspection_id' => $inspectionLog->id,
                    'question_id' => $questionId,
                    'answer' => $answer,
                ]);
            }

            return redirect()->route('maintenance.ShowConfirmation')->with('success', 'Inspection completed successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e);
        }
    }


    public function ShowRecentInspected()
    {
        $latestIds = InspectionLogs::select(DB::raw('MAX(id) as id'))->groupBy('extinguisher_id')->pluck('id');
        $items = InspectionLogs::with(['user', 'extinguisher'])->where('inspected_by', Auth::id())->latest()->paginate(20);
        return view('Maintenance.logs.logs', compact('items'));
    }

    public function ShowInspectionAnswer($id)
    {
        $details = InspectionLogs::with(['user', 'extinguisher'])->find($id);
        $items = InspectionAnswer::with(['questions'])->where('inspection_id', $details->id)->get();
        return view('Maintenance.logs.answers', compact('details', 'items'));
    }
}
