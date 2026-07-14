<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\Centre;
use Illuminate\Http\Request;

class RegionsCentresController extends Controller
{
    public function index()
    {
        $regions = Region::withCount('centres')->get();
        $centres = Centre::with(['region', 'utilisateur'])->get();
        
        return view('regions_centres.index', compact('regions', 'centres'));
    }
}