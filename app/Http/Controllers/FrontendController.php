<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Campaign;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function loadCampaign(Campaign $campaign, Request $request)
    {
        $user = auth()->user();
        if (!isset($user)) {
            $username = $request->get('a');
            $user = User::where('name', $username)->first();
        }
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
