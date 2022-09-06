<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Isp;
use App\Models\MobileCarrier;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DictionaryController extends Controller
{
    public function getIsps(Request $request)
    {
        $q = $request['query'];
        $isps = Isp::where('name', 'ILIKE', "%{$q}%")->get();
        return response()->json([
            'isps' => $isps,
            'ss' => $request['query']
        ]);
    }
    public function getCity(Request $request)
    {
        $q = $request['query'];
        $isps = City::where('name', 'ILIKE', "%{$q}%")->get();
        return response()->json([
            'cities' => $isps,
            'ss' => $request['query']
        ]);
    }
    public function getMobileCarreir(Request $request)
    {
        $q = $request['query'];
        $mobiles = MobileCarrier::where('name', 'ILIKE', "%{$q}%")->get();
        return response()->json([
            'mobiles' => $mobiles,
            'ss' => $request['query']
        ]);
    }
    public function getRegions(Request $request)
    {
        $q = $request['query'];
        $regions = Region::where('name', 'ILIKE', "%{$q}%")->get();
        return response()->json([
            'regions' => $regions,
            'ss' => $request['query']
        ]);
    }
}
