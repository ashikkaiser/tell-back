<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Column;
use App\Models\Country;
use App\Models\Lander;
use App\Models\TokenDictionary;
use App\Models\TrackingDomain;
use App\Models\Workspace;
use Illuminate\Http\Request;

class LandersController extends Controller
{
    public function common()
    {
        $workSpaces =  Workspace::where('user_id', auth()->user()->id)->get();
        $countries =  Country::all();
        $domains =  TrackingDomain::all();
        $tokens = TokenDictionary::all();

        return response()->json([
            'success' => true,
            'workSpaces' => $workSpaces,
            'countries' => $countries,
            'domains' => $domains,
            'tokens' => $tokens,
        ]);
    }

    public function allLanders()
    {
        $landers = Lander::where('user_id', auth()->user()->id)->get()->map(function ($data) {
            return [
                "id" => $data->id,
                "key" => $data->id,
                "name" => $data->name,
                "workspace" => $data->workspace->name,
            ];
        });

        $columns = Column::where('user_id', auth()->user()->id)->whereIn('column_for', ['global', 'offers'])->orderBy('seq')->get();
        return compact('landers', 'columns');
    }
    public function addLander(Request $request)
    {
        try {

            $lander = new Lander();
            $lander->name = Country::find($request->country_id)->name . "-" . $request->name;
            $lander->user_id = auth()->user()->id;
            $lander->workspace_id = $request->workspace_id;
            $lander->country_id = $request->country_id;
            $lander->url = $request->url;
            $lander->domain_id = $request->domain_id;
            $lander->no_of_cta = $request->no_of_cta;
            $lander->tags = json_encode($request->tags);
            $lander->save();
            return response()->json([
                'message' => 'Lander Created Successfully',
                'landers' =>  [
                    "id" => $lander->id,
                    "key" => $lander->id,
                    "name" => $lander->name,
                    "workspace" => $lander->workspace->name,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something Went Wrong', 'type' => 'message'], 401);
        }
    }

    public function view($id)
    {
        $workSpaces =  Workspace::where('user_id', auth()->user()->id)->get();
        $countries =  Country::all();
        $domains =  TrackingDomain::all();
        $lander = Lander::find($id);
        $tokens = TokenDictionary::all();


        return response()->json([
            'success' => true,
            'workSpaces' => $workSpaces,
            'countries' => $countries,
            'domains' => $domains,
            'lander' => $lander,
            'tokens' => $tokens,


        ]);
    }
    public function editLander(Request $request, $id)
    {
        try {

            $lander = Lander::find($id);
            $lander->name = Country::find($request->country_id)->name . "-" . $request->name;
            $lander->workspace_id = $request->workspace_id;
            $lander->country_id = $request->country_id;
            $lander->url = $request->url;
            $lander->domain_id = $request->domain_id;
            $lander->no_of_cta = $request->no_of_cta;
            $lander->tags = json_encode($request->tags);
            $lander->save();
            return response()->json([
                'message' => 'Lander Updated Successfully',
                'offers' =>  [
                    "id" => $lander->id,
                    "key" => $lander->id,
                    "name" => $lander->name,
                    "workspace" => $lander->workspace->name,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something Went Wrong', 'type' => 'message'], 401);
        }
    }
}
