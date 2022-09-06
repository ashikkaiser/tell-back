<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\AffiliateNetwork;
use App\Models\Column;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Offer;
use App\Models\TimeZone;
use App\Models\TokenDictionary;
use App\Models\TrackingDomain;
use App\Models\TrackingMethod;
use App\Models\Workspace;
use Illuminate\Http\Request;

class OffersController extends Controller
{
    public function common()
    {
        $workSpaces =  Workspace::where('user_id', auth()->user()->id)->get();
        $networks =  AffiliateNetwork::all();
        $countries =  Country::all();
        $domains =  TrackingDomain::all();
        $curencies =  Currency::all();
        $tokens = TokenDictionary::all();
        $timezones = TimeZone::all();
        $trackings = TrackingMethod::all();

        return response()->json([
            'success' => true,
            'workSpaces' => $workSpaces,
            'networks' => $networks,
            'countries' => $countries,
            'tokens' => $tokens,
            'domains' => $domains,
            'curencies' => $curencies,
            'timezones' => $timezones,
            'trackings' => $trackings,


        ]);
    }

    public function allOffers()
    {
        $offers = Offer::where('user_id', auth()->user()->id)->get()->map(function ($data) {
            return [
                "id" => $data->id,
                "key" => $data->id,
                "name" => $data->name,
                "workspace" => $data->workspace->name,
            ];
        });

        $columns = Column::where('user_id', auth()->user()->id)->whereIn('column_for', ['global', 'offers'])->orderBy('seq')->get();
        return compact('offers', 'columns');
    }
    public function addOffer(Request $request)
    {
        try {

            $offer = new Offer();
            $offer->name = $request->name;
            $offer->user_id = auth()->user()->id;
            $offer->workspace_id = $request->workspace_id;
            $offer->affiliate_network_id = $request->affiliate_network_id;
            $offer->country_id = $request->country_id;
            $offer->offer_url = $request->offer_url;
            $offer->domain_id = $request->domain_id;

            $offer->tags = json_encode($request->tags);
            $offer->payout_type = $request->payout_type;

            $offer->payout = $request->payout;
            $offer->currency_id = $request->currency_id;

            $offer->tracking_method_id = $request->tracking_method_id;
            $offer->cap_enabled = $request->cap_enabled;
            $offer->cap_size = $request->cap_size;
            $offer->time_zone_id = $request->time_zone_id;


            $offer->save();
            return response()->json([
                'message' => 'Offer  Created Successfully',
                'offers' =>  [
                    "id" => $offer->id,
                    "key" => $offer->id,
                    "name" => $offer->name,
                    "workspace" => $offer->workspace->name,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something Went Wrong', 'type' => 'message'], 401);
        }
    }

    public function view($id)
    {
        $workSpaces =  Workspace::where('user_id', auth()->user()->id)->get();
        $networks =  AffiliateNetwork::all();
        $countries =  Country::all();
        $domains =  TrackingDomain::all();
        $curencies =  Currency::all();
        $tokens = TokenDictionary::all();
        $timezones = TimeZone::all();
        $trackings = TrackingMethod::all();
        $offer = Offer::find($id);

        return response()->json([
            'success' => true,
            'workSpaces' => $workSpaces,
            'networks' => $networks,
            'countries' => $countries,
            'tokens' => $tokens,
            'domains' => $domains,
            'curencies' => $curencies,
            'timezones' => $timezones,
            'trackings' => $trackings,
            'offer' => $offer,


        ]);
    }
    public function editOffer(Request $request, $id)
    {
        try {

            $offer = Offer::find($id);
            $offer->name = $request->name;
            $offer->workspace_id = $request->workspace_id;
            $offer->affiliate_network_id = $request->affiliate_network_id;
            $offer->country_id = $request->country_id;
            $offer->offer_url = $request->offer_url;
            $offer->domain_id = $request->domain_id;

            $offer->tags = json_encode($request->tags);
            $offer->payout_type = $request->payout_type;

            $offer->payout = $request->payout;
            $offer->currency_id = $request->currency_id;

            $offer->tracking_method_id = $request->tracking_method_id;
            $offer->cap_enabled = $request->cap_enabled;
            $offer->cap_size = $request->cap_size;
            $offer->time_zone_id = $request->time_zone_id;


            $offer->save();
            return response()->json([
                'message' => 'Offer  Updated Successfully',
                'offers' =>  [
                    "id" => $offer->id,
                    "key" => $offer->id,
                    "name" => $offer->name,
                    "workspace" => $offer->workspace->name,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something Went Wrong', 'type' => 'message'], 401);
        }
    }
}
