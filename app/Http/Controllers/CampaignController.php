<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CampaignController extends Controller
{
    /**
     * Display list of campaigns and aggregate revenue for each campaign
     */
    public function index(Request $request)
    {
        // @TODO implement
        // Get perPage from the query parameters, default to 10 if not provided
        $perPage = $request->input('perPage', 10); 
        $campaigns = DB::table('stats')
        ->join('campaigns', 'stats.campaign_id', '=', 'campaigns.id')
        ->select('campaigns.id', 'campaigns.utm_campaign', DB::raw('SUM(stats.revenue) as total_revenue'))
        ->groupBy('campaigns.id', 'campaigns.utm_campaign') // Added both columns to the GROUP BY
        ->paginate($perPage); // Use the dynamic perPage value
        // ->get();

        return view('campaigns.index', compact('campaigns'));
    }

    /**
     * Display a specific campaign with a hourly breakdown of all revenue
     */
    public function show(Campaign $campaign, Request $request)
    {
        // @TODO implement
        // Get perPage from the query parameters, default to 10 if not provided
        $perPage = $request->input('perPage', 10);
        $details = DB::table('stats')
            ->join('campaigns', 'stats.campaign_id', '=', 'campaigns.id')
            ->select('stats.event_date', 'stats.event_hour', DB::raw('SUM(stats.revenue) as total_revenue'))
            ->where('stats.campaign_id', $campaign->id)
            ->groupBy('stats.event_date', 'stats.event_hour')
            ->paginate($perPage); // Use the dynamic perPage value
            // ->get();
            
        return view('campaigns.details', compact('details', 'campaign'));
    }

    /**
     * Display a specific campaign with the aggregate revenue by utm_term
     */
    public function publishers(Campaign $campaign, Request $request)
    {
        // @TODO implement
        // Get perPage from the query parameters, default to 10 if not provided
        $perPage = $request->input('perPage', 10);
        $terms = DB::table('stats')
            ->join('terms', 'stats.term_id', '=', 'terms.id')
            ->select('terms.utm_term', DB::raw('SUM(stats.revenue) as total_revenue'))
            ->where('stats.campaign_id', $campaign->id)
            ->groupBy('terms.id', 'terms.utm_term')
            ->paginate($perPage); // Use the dynamic perPage value
            // ->get();

        return view('campaigns.terms', compact('terms', 'campaign'));
    }
}
