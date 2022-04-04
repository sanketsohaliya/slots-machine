<?php

namespace App\Http\Controllers;

use App\Models\Campaign;

class FrontendController extends Controller
{
    public function loadCampaign(Campaign $campaign)
    {
        $user = auth()->user();
        $symbols = unserialize($campaign->symbols);
        $weights = unserialize($campaign->weights)['weights'];
        foreach ($weights as $i => $weight) {
            $points[$i] = explode(',', $weight);
        }
        for ($i = 0; $i < 3; $i++) {
            for ($j = 0; $j < 5; $j++) {
                $reels[$i][$j] = $symbols[array_rand($symbols)];
            }
        }
        if (request()->ajax()) {
            $remaining_spins = $user->remaining_spins;
            if ($remaining_spins > 0) {
                $user->remaining_spins--;
                $user->save();
                return response()->json(['symbols' => $symbols, 'reels' => $reels, 'remaining_spins' => $remaining_spins, 'weights' => $points]);
            }
        }
        return view('frontend.index', ['reels' => $reels]);
    }

    public function placeholder()
    {
        return view('frontend.placeholder');
    }
}
