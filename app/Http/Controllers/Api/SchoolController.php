<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function index()
    {
        return School::with(['region', 'region.oblast'])->get(['id', 'name', 'region_id']);
    }

    public function getSchoolsByRegionId(Request $request)
    {
        $schools = School::where('region_id', $request->id)->get();

        return response()->json($schools);
    }
}
