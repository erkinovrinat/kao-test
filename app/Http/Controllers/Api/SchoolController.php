<?php

namespace App\Http\Controllers\Api;

use App\School;
use Illuminate\Http\Request;

class SchoolController extends \App\Http\Controllers\SchoolController
{
    public function getSchoolsByRegionId(Request $request)
    {
        $schools = School::where('region_id', $request->id)->get();

        return response()->json($schools);
    }
}
