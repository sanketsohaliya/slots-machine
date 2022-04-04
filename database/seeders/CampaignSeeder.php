<?php

namespace Database\Seeders;

use App\Models\Campaign;
use Illuminate\Database\Seeder;

class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Campaign::truncate();

        $symbols = [
            'apple.png',
            'bananas.png',
            'durian.png',
            'lemon.png',
            'orange.png',
            'strawberry.png',
        ];

        $weights = [
            [10, 20, 30],
            [40, 50, 60],
            [70, 80, 90],
            [100, 110, 120],
            [130, 140, 150],
            [160, 170, 180],
        ];

        Campaign::create([
            'timezone' => 'Europe/London',
            'name' => 'Test Campaign 1',
            'symbols' => serialize($symbols),
            'weights' => serialize($weights),
            'starts_at' => now()->startOfDay(),
            'ends_at' => now()->addDays(7)->endOfDay(),
        ]);

        Campaign::create([
            'timezone' => 'Europe/London',
            'name' => 'Test Campaign 2',
            'symbols' => serialize($symbols),
            'weights' => serialize($weights),
            'starts_at' => now()->startOfDay(),
            'ends_at' => now()->addDays(7)->endOfDay(),
        ]);
    }
}
