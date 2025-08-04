<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Mark;
use App\Models\Mcq;
use App\Models\PageDesign;
use App\Models\Student;
use Illuminate\Http\Request;

class ReportController extends Controller
{

    //index page
    public function studentQuestionCheck()
    {
        //exclude ipe,mme
        $departments = Department::whereNotIn('id', [7, 10])->orderBy('id')->get();

        return view('report.student_15_question_index', compact('departments'));
    }

    //report print
    public function studentQuestionCheckByDepartment($id)
    {
        $department=Department::where('id',$id)->first();
        $students = Student::with(['evaluations' => function ($q) {
            $q->select('id', 'student_id', 'page_design_id');
        }])
            ->where('department_id', $id)
            ->get();

        $totalPageDesigns = PageDesign::where('department_id', $id)->pluck('id')->toArray();

       /* return response()->json([
            'students' => $students,
            'totalPageDesigns' => $totalPageDesigns
        ]);*/
        return view('report.student_15_question_department', compact('students', 'totalPageDesigns','department'));
    }
    public function englishMcqPass()
    {
        $departments = Department::all();

        return view('report.english_mcq_pass_index', compact('departments'));
    }

    public function englishMcqPassByDepartment($id)
    {

        //return $id;
        // Threshold: 20% of 15 = 3 marks
       // $passMark = 0.20 * 15;
       $passMark = 3;

        if ($id == 0) {
         /*   // All departments
            $students = Mcq::where('mp1_eng', '>=', $passMark)
                ->with('student.department')
                ->get();
            $title = 'All Departments - English MCQ Passed Students';*/
        } else {
            // Specific department
            $department = Department::findOrFail($id);

            $marks = Mark::where('mcq_eng', '>=', $passMark)
                ->whereHas('student', function ($q) use ($id) {
                    $q->where('department_id', $id);
                })
                ->with('student.department')
                ->get();

            //return $marks;

        }

        //return $students;
        return view('report.english_mcq_pass_department', compact('marks'));
    }


    public function firstPartPass()
    {
        $departments = Department::all();

        return view('report.first_part_pass_index', compact('departments'));
    }

    public function secondPartPass()
    {
        $departments = Department::all();

        return view('report.second_part_pass_index', compact('departments'));
    }

    public function firstSecondPartPass()
    {
        $departments = Department::all();

        return view('report.first_second_part_pass_index', compact('departments'));
    }





    public function firstPartPass1()
    {
      /*  // Get all students with first_part_passed = 1
        $marks = Mark::where('first_passed', 1)
            ->with('student', 'department')  // Using eager loading to load student and department details
            ->get();

        return view('report.first_part_pass', compact('marks'));*/
    }
}
