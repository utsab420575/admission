<?php

namespace App\Http\Controllers;


use App\Models\Department;
use App\Models\Examiner;
use App\Models\PageDesign;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CoordinatorController extends Controller
{
    public function examinerAssign(){
        //$all_page_designs=PageDesign::all();
        //$all_question_assigns = PageDesign::orderBy('quest_no')->get();
        $all_question_assigns = PageDesign::with(['department', 'group', 'partType', 'examiner'])
            ->orderBy('quest_no')
            ->get();
        // Fetch all examiners by role name
        $examiners = User::role('Examiner')->get(); // Spatie's way
       // return $examiners;
        return view('coordinator_panel.examiner_assign', compact('all_question_assigns','examiners'));
    }

    public function storeExaminerAssign(Request $request)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'examiners' => 'required|array',
            'examiners.*' => 'nullable|exists:users,id',
        ]);

        DB::beginTransaction();

        $department = Department::find($request->department_id);
        //return $department;
        try {
            foreach ($request->examiners as $pageDesignId => $userId) {
                if (!$userId) continue;

                Examiner::updateOrCreate(
                    [
                        'page_design_id' => $pageDesignId,
                    ],
                    [
                        'user_id' => $userId,
                    ]
                );
            }

            DB::commit();

            $notifications = [
                "message" => "Examiner Added Successfully For {$department->name} Department",
                "alert-type" => 'success',
            ];

            return redirect()->back()
                ->with('active_tab', $request->department_id) // pass department ID
                ->with($notifications);

        } catch (\Exception $e) {
            DB::rollBack();

            // Crucial error log
            Log::error('Failed to assign examiners', [
                'department_id' => $request->department_id,
                'examiners' => $request->examiners,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->with([
                "message" => "Something went wrong. No data was saved.",
                "alert-type" => "error"
            ]);
        }
    }
}
