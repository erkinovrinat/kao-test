<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Oblast;
use App\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $students = User::filterResolver($request);
        $oblasts = Oblast::all(['id', 'name']);

        return view('reports.index', [
            'oblasts' => $oblasts,
            'students' => $students,
            'oblast_id' => $request->oblast_id ?: null,
            'region_id' => $request->region_id ?: null,
            'school_id' => $request->school_id ?: null,
            'grade_id' => $request->grade_id ?: null,
            'student_id' => $request->student_id ?: null,
        ]);
    }

    public function export(Request $request)
    {
        $students = User::filterResolver($request);

        $export = new UsersExport($students);

        return Excel::download($export, 'students.xlsx');
    }
}
