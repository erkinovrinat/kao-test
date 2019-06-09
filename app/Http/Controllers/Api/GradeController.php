<?php

namespace App\Http\Controllers\Api;

use App\Grade;
use Illuminate\Http\Request;

class GradeController extends \App\Http\Controllers\GradeController
{
    public function index()
    {
        $grades = Grade::all();

        return response()->json($grades);
    }
}
