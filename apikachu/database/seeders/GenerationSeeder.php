<?php

namespace Database\Seeders;

use App\Models\Generation;
use Illuminate\Database\Seeder;

class GenerationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Generation::insertOrIgnore([
            ['generation' => 1],
            ['generation' => 2],
            ['generation' => 3],
            ['generation' => 4],
            ['generation' => 5],
            ['generation' => 6],
        ], ['generation']);
    }
}
