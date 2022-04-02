<?php

namespace App\Http\Controllers;

use App\Models\Campaign;

class FrontendController extends Controller
{
    public function loadCampaign(Campaign $campaign)
    {
        $symbols = unserialize($campaign->symbols);
        for ($i = 0; $i < 3; $i++) {
            for ($j = 0; $j < 5; $j++) {
                $reels[$i][$j] = array_rand($symbols);
            }
        }
        return view('frontend.index', ['reels' => $reels]);
    }

    public function placeholder()
    {
        return view('frontend.placeholder');
    }
}
