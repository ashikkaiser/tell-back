<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Column;
use App\Models\Currency;
use App\Models\SampleTrafficSource;
use App\Models\TokenDictionary;
use App\Models\TrafficSource;
use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TrafficSourceController extends Controller
{
    public function common(Request $request)
    {
        $sampleTrafficSource =  SampleTrafficSource::all();

        $curencies =  Currency::all();
        $tokens = TokenDictionary::all();
        $workSpaces =  Workspace::where('user_id', auth()->user()->id)->get();
        return response()->json([
            'success' => true,
            'sampleTrafficSource' => $sampleTrafficSource,
            'tokens' => $tokens,
            'curencies' => $curencies,
            'workSpaces' => $workSpaces,

        ]);
    }

    public function addTrafficSource(Request $request)
    {
        $traffic = new TrafficSource();
        $traffic->name = $request->name;
        $traffic->user_id = auth()->user()->id;
        $traffic->workspace_id = $request->workspace_id;
        $traffic->currency_id = $request->currency_id;
        $req = collect($request->all())->keys()->all();
        $matches  = preg_grep('/^parameters_(\d+)/i', $req);
        $params = array();
        foreach ($matches as $m) {
            array_push($params, $request[$m]);
        }
        $traffic->parameters = json_encode($params);
        $traffic->postback_url = $request->postback_url;
        $traffic->pixal_redirect_enabled = $request->pixal_redirect_enabled;
        $traffic->postback_url_enabled = $request->postback_url_enabled;
        $traffic->pixal_redirect_url = $request->pixal_redirect_url;
        $traffic->impression_tracking = $request->impression_tracking;
        $traffic->direct_tracking = $request->direct_tracking;
        $traffic->save();
        return response()->json([
            'message' => 'Traffic Source Created Successfully',
            'trafficSources' =>  [
                "id" => $traffic->id,
                "key" => $traffic->id,
                "name" => $traffic->name,
                "workspace" => $traffic->workspace->name,
            ]
        ]);
    }

    public function allTrafficSource(Request $request)
    {
        $trafficSources = TrafficSource::where('user_id', auth()->user()->id)->get()->map(function ($data) {
            return [
                "id" => $data->id,
                "key" => $data->id,
                "name" => $data->name,
                "workspace" => $data->workspace->name,
            ];
        });

        $columns = Column::where('user_id', auth()->user()->id)->whereIn('column_for', ['global', 'networks'])->orderBy('seq')->get();
        return compact('trafficSources', 'columns');
    }

    public function view($id)
    {
        $curencies =  Currency::all();
        $tokens = TokenDictionary::all();
        $workSpaces =  Workspace::where('user_id', auth()->user()->id)->get();
        $trafficSources =  TrafficSource::where('user_id', auth()->user()->id)->where('id', $id)->first();
        return response()->json([
            'success' => true,
            'trafficSources' => $trafficSources,
            'tokens' => $tokens,
            'curencies' => $curencies,
            'workSpaces' => $workSpaces,

        ]);
    }

    public function editTrafficSource(Request $request, $id)
    {
        try {
            $traffic = TrafficSource::find($id);
            $traffic->name = $request->name;
            $traffic->workspace_id = $request->workspace_id;
            $traffic->currency_id = $request->currency_id;
            $req = collect($request->all())->keys()->all();
            $matches  = preg_grep('/^parameters_(\d+)/i', $req);
            $params = array();
            foreach ($matches as $m) {
                array_push($params, $request[$m]);
            }
            $traffic->parameters = json_encode($params);
            $traffic->postback_url = $request->postback_url;
            $traffic->pixal_redirect_enabled = $request->pixal_redirect_enabled;
            $traffic->postback_url_enabled = $request->postback_url_enabled;
            $traffic->pixal_redirect_url = $request->pixal_redirect_url;
            $traffic->impression_tracking = $request->impression_tracking;
            $traffic->direct_tracking = $request->direct_tracking;
            $traffic->save();
            return response()->json([
                'type' => 'message',
                'message' => 'Traffic Source Updates Successfully',
                'trafficSources' =>  [
                    "id" => $traffic->id,
                    "key" => $traffic->id,
                    "name" => $traffic->name,
                    "workspace" => $traffic->workspace->name,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something Went Wrong', 'type' => 'message'], 401);
        }
    }
}
