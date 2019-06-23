<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function index()
    {
        return Region::with('oblast')->get(['id', 'name', 'oblast_id']);
    }

    public function getRegionsByOblastId(Request $request)
    {
        $regions = Region::where('oblast_id', $request->id)->get();

        return response()->json($regions);
    }
}
