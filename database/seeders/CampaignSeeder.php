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
            // 'https://via.placeholder.com/50.png/FFFF00/000000?text=Y',
        ];

        Campaign::create([
            'timezone' => 'Europe/London',
            'name' => 'Test Campaign 1',
            'symbols' => serialize($symbols),
            'weights' => serialize([3, 6, 2, 7, 9, 10]),
            'starts_at' => now()->startOfDay(),
            'ends_at' => now()->addDays(7)->endOfDay(),
        ]);

        Campaign::create([
            'timezone' => 'Europe/London',
            'name' => 'Test Campaign 2',
            'symbols' => serialize($symbols),
            'weights' => serialize([2, 9, 3, 8, 3, 4]),
            'starts_at' => now()->startOfDay(),
            'ends_at' => now()->addDays(7)->endOfDay(),
        ]);
    }
}
