<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\AffiliateNetwork;
use App\Models\Column;
use App\Models\Currency;
use App\Models\Offer;
use App\Models\SampleAffiliateNetwork;
use App\Models\TrackingDomain;
use App\Models\TrackingMethod;
use App\Models\Workspace;
use Illuminate\Http\Request;

class AffiliateNetworkController extends Controller
{
    public function common(Request $request)
    {
        $sampleAffiliateNetworks =  SampleAffiliateNetwork::all();
        $trackingDomains =  TrackingDomain::all();
        $curencies =  Currency::all();
        $trackings =  TrackingMethod::all();
        $workSpaces =  Workspace::where('user_id', auth()->user()->id)->get();
        return response()->json([
            'success' => true,
            'sampleAffiliateNetworks' => $sampleAffiliateNetworks,
            'trackingDomains' => $trackingDomains,
            'curencies' => $curencies,
            'workSpaces' => $workSpaces,
            'trackings' => $trackings,

        ]);
    }

    public function addNetwork(Request $request)
    {
        $network = new AffiliateNetwork();
        $network->name = $request->name;
        $network->user_id = auth()->user()->id;
        $network->domain_id = $request->domain_id;
        $network->workspace_id = $request->workspace_id;
        $network->tracking_method_id = $request->tracking_method_id;
        $network->postback_url = $request->postback_url;
        $network->currency_id = $request->currency_id;
        $network->parameters = json_encode(array($request->click_id, $request->payout, $request->txid, $request->event_type));
        $network->append_click_id = $request->append_click_id;
        $network->accept_duplicate_postBack = $request->accept_duplicate_postBack;
        $network->accept_from_whitelist_only = $request->accept_from_whitelist_only;
        $network->whiteListIPs = $request->whiteListIPs;
        $network->save();
        return response()->json([
            'message' => 'Affiliate Network Created Successfully',
            'network' =>  [
                "id" => $network->id,
                "key" => $network->id,
                "name" => $network->name,
                "workspace" => $network->workspace->name,
            ]
        ]);
    }
    public function editNetwork(Request $request, $id)
    {
        $network = AffiliateNetwork::find($id);
        $network->name = $request->name;
        $network->user_id = auth()->user()->id;
        $network->domain_id = $request->domain_id;
        $network->workspace_id = $request->workspace_id;
        $network->tracking_method_id = $request->tracking_method_id;
        $network->postback_url = $request->postback_url;
        $network->currency_id = $request->currency_id;
        $network->parameters = json_encode(array($request->click_id, $request->payout, $request->txid, $request->event_type));
        $network->append_click_id = $request->append_click_id;
        $network->accept_duplicate_postBack = $request->accept_duplicate_postBack;
        $network->accept_from_whitelist_only = $request->accept_from_whitelist_only;
        $network->whiteListIPs = $request->whiteListIPs;
        $network->save();
        return response()->json([
            'message' => 'Affiliate Network Updated Successfully',
            'network' =>  [
                "id" => $network->id,
                "key" => $network->id,
                "name" => $network->name,
                "workspace" => $network->workspace->name,
            ]
        ]);
    }

    public function allNetworks()
    {
        $networks = AffiliateNetwork::where('user_id', auth()->user()->id)->get()->map(function ($data) {
            return [
                "id" => $data->id,
                "key" => $data->id,
                "name" => $data->name,
                "workspace" => $data->workspace->name,
            ];
        });
        $columns = Column::where('user_id', auth()->user()->id)->whereIn('column_for', ['global', 'networks'])->orderBy('seq')->get();
        return compact('networks', 'columns');
    }

    public function delete(Request $request)
    {
        AffiliateNetwork::findMany($request->ids)->delete();
        Offer::whereIn('affiliate_network_id', $request->ids)->delete();

        return response()->json([
            'success' => true,
            'message' => "Affilaite Network Deleted Successfully!!",

        ]);
    }

    public function view($id)
    {
        $trackingDomains =  TrackingDomain::all();
        $curencies =  Currency::all();
        $workSpaces =  Workspace::where('user_id', auth()->user()->id)->get();
        $network = AffiliateNetwork::find($id);
        $trackings =  TrackingMethod::all();
        return response()->json([
            'success' => true,
            'network' => $network,
            'trackingDomains' => $trackingDomains,
            'curencies' => $curencies,
            'workSpaces' => $workSpaces,
            'trackings' => $trackings,

        ]);
    }
}
