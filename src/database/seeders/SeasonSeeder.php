<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Season;

class SeasonSeeder extends Seeder
{
    public function run()
    {
        Season::create(['name' => '春']);
        Season::create(['name' => '夏']);
        Season::create(['name' => '秋']);
        Season::create(['name' => '冬']);
    }
}
