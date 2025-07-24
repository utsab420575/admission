<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function englishMcqPass()
    {
        // Get all students with eng_passed = 1
        $marks = Mark::where('eng_passed', 1)
            ->with('student', 'department')  // Using eager loading to load student and department details
            ->get();

        return view('report.english_mcq_pass', compact('marks'));
    }

    public function firstPartPass()
    {
        // Get all students with first_part_passed = 1
        $marks = Mark::where('first_passed', 1)
            ->with('student', 'department')  // Using eager loading to load student and department details
            ->get();

        return view('report.first_part_pass', compact('marks'));
    }
}
