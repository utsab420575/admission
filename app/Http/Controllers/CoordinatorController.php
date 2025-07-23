<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CoordinatorController extends Controller
{
    public function examinerAssign(){
        $all_page_designs=PageDesign::all();
        return view('coordinator_panel.examiner_assign', compact('all_page_designs'));
    }
}
