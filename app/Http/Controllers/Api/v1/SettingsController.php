<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Column;
use App\Models\Currency;
use App\Models\GeneralSetting;
use App\Models\TimeZone;
use App\Models\TrackingDomain;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function resizeColumn(Request $request, $id)
    {
        $column = Column::where('user_id', auth()->user()->id)->where('id', $id)->first();
        $column->width = $request->width;
        $column->save();
        return true;
    }
    public function global()
    {
        // $settings = GeneralSetting::where('user_id', auth()->user()->id)->get();
        return response()->json([
            'success' => true,
            'timezones' => TimeZone::all(),
            'currencies' => Currency::all(),
            // 'settings' => $settings
        ]);
    }
    public function domains()
    {
        $defaults = TrackingDomain::where('type', 'default')->get()->map(function ($data) {
            return [
                'id' => $data->id,
                "domain" => $data->domain,
                "type" => $data->type,
                'workspace' => "Public Workspace"
            ];
        });
        $customs = TrackingDomain::where('user_id', auth()->user()->id)->where('type', 'custom')->get()->map(
            function ($data) {
                return [
                    'id' => $data->id,
                    "domain" => $data->domain,
                    "type" => $data->type,
                    'workspace' => "Public Workspace"
                ];
            }
        );

        return response()->json([
            'success' => true,
            'defaults' => $defaults,
            'customs' => $customs,

        ]);
    }

    public function settings(Request $request)
    {

        $exists =   GeneralSetting::where('user_id', auth()->user()->id)->exists();
        $settings = GeneralSetting::where('user_id', auth()->user()->id)->firstOr(function () use ($request) {
            if ($request->method() == 'POST') {
                try {
                    $settings = new GeneralSetting();
                    $data = $request->only('home_screen', 'time_zone_id', 'currency_id', 'main_domain_id', 'redirect_domain_id');
                    $settings->user_id  = auth()->user()->id;

                    foreach ($data as $key => $req) {
                        $settings[$key] = $req;
                    }

                    $settings->save();
                    return response()->json(['success' => true, 'settings' => $settings, 'message' => "General Setting Updated Successfully"]);
                } catch (\Exception $e) {

                    return response()->json(['message' => 'Something Went Wrong', 'type' => 'message'], 401);
                }
            }
        });
        if ($exists) {
            if ($request->method() == 'POST') {
                try {
                    $data = $request->only('home_screen', 'time_zone_id', 'currency_id', 'main_domain_id', 'redirect_domain_id');
                    $settings->user_id  = auth()->user()->id;

                    foreach ($data as $key => $req) {
                        $settings[$key] = $req;
                    }

                    $settings->save();
                    return response()->json(['success' => true, 'settings' => $settings, 'message' => "General Setting Updated Successfully"]);
                } catch (\Exception $e) {

                    return response()->json(['message' => 'Something Went Wrong', 'type' => 'message'], 401);
                }
            }
        }


        return response()->json(['success' => true, 'settings' => $settings]);
    }
}
