<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Examiner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExaminerController extends Controller
{
    public function ExaminerDashboard(){
        $userId = Auth::id();

        //userid=5 have 3 paper, 3=>[6, 7, 9]
        // Get all page_design_ids assigned to this examiner
        $assignedPageDesignIds = Examiner::where('user_id', $userId)->pluck('page_design_id');


        //total assigned
        $totalAssigned = Examiner::where('user_id', $userId)->count();

        //complete
        $completeEvaluationCount = Evaluation::whereIn('page_design_id', $assignedPageDesignIds)
            ->where('status', 2)
            ->count();


        // 1 means need approval from scrutinizer
        $pendingEvaluationCount = Evaluation::whereIn('page_design_id', $assignedPageDesignIds)
            ->where('status', 1)
            ->count();


        //dispute:10:Examiner dispute 11:Scrutinizer dispute
        $disputeEvaluationCount = Evaluation::whereIn('page_design_id', $assignedPageDesignIds)
            ->where('status', 10)
            ->orWhere('status',11)
            ->count();


        return view('examiner_panel.start_entry', compact(
            'totalAssigned',
            'completeEvaluationCount',
            'pendingEvaluationCount',
            'disputeEvaluationCount'
        ));
        //return view('examiner_panel.start_entry');
    }
}
