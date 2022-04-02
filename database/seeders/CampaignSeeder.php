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
            'https://via.placeholder.com/50.png?text=Q' => '2',
            'https://via.placeholder.com/50.png?text=W' => '4',
            'https://via.placeholder.com/50.png?text=E' => '1',
            'https://via.placeholder.com/50.png?text=R' => '3',
            'https://via.placeholder.com/50.png?text=T' => '6',
            'https://via.placeholder.com/50.png?text=Y' => '5',
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