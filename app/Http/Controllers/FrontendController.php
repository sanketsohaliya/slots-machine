<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Game;
use App\Models\Campaign;
use Illuminate\Http\Request;


class FrontendController extends Controller
{
    public function loadCampaign(Campaign $campaign, Request $request)
    {
        $user = auth()->user();
        if (!session()->has('activeGame')) {
            $game = Game::create([
                'campaign_id' => $campaign->id,
                'prize_id' => null,
                'account' => $user->name
            ]);
            session()->put('activeGame', $game);
        }
        $symbols = unserialize($campaign->symbols);
        $reels = $this->getReels($symbols);
        $weights = unserialize($campaign->weights)['weights'];
        $points = $this->getPoints($weights);
        if (request()->ajax()) {
            $game = session()->get('activeGame');
            if (request()->has('won')) {
                $game->prize_id = mt_rand(1, 18);
                $game->save();
            } else {
                if (empty($game->revealed_at)) {
                    $game->revealed_at = Carbon::now()->setTimezone($campaign->timezone);
                    $game->save();
                }
                $remaining_spins = $user->remaining_spins;
                if ($remaining_spins > 0) {
                    $user->remaining_spins--;
                    $user->save();
                    return response()->json(['symbols' => $symbols, 'reels' => $reels, 'remaining_spins' => $remaining_spins, 'weights' => $points]);
                }
            }
        }
        return view('frontend.index', ['reels' => $reels]);
    }

    public function placeholder()
    {
        return view('frontend.placeholder');
    }

    protected function getReels($symbols)
    {
        for ($i = 0; $i < 3; $i++) {
            for ($j = 0; $j < 5; $j++) {
                $reels[$i][$j] = $symbols[array_rand($symbols)];
            }
        }
        return $reels;
    }

    protected function getPoints($weights)
    {
        foreach ($weights as $i => $weight) {
            $points[$i] = explode(',', $weight);
        }
        return $points;
    }
}
