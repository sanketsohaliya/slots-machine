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
            'apple.png' => '2',
            'bananas.png' => '4',
            'durian.png' => '1',
            'lemon.png' => '3',
            'orange.png' => '6',
            'strawberry.png' => '5',
            // 'https://via.placeholder.com/50.png/FFFF00/000000?text=Y' => '5',
        ];

        Campaign::create([
            'timezone' => 'Europe/London',
            'name' => 'Test Campaign 1',
            'symbols' => serialize($symbols),
            'starts_at' => now()->startOfDay(),
            'ends_at' => now()->addDays(7)->endOfDay(),
        ]);

        Campaign::create([
            'timezone' => 'Europe/London',
            'name' => 'Test Campaign 2',
            'symbols' => serialize($symbols),
            'starts_at' => now()->startOfDay(),
            'ends_at' => now()->addDays(7)->endOfDay(),
        ]);
    }
}
