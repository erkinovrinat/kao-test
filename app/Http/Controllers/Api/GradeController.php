<?php

namespace App\Http\Controllers\Api;

use App\Grade;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index()
    {
        $grades = Grade::all();

        return response()->json($grades);
    }
}
