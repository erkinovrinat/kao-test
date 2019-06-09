<?php

namespace App\Http\Controllers\Api;

use App\Region;
use Illuminate\Http\Request;

class RegionController extends \App\Http\Controllers\RegionController
{
    public function getRegionsByOblastId(Request $request)
    {
        $regions = Region::where('oblast_id', $request->id)->get();

        return response()->json($regions);
    }
}
