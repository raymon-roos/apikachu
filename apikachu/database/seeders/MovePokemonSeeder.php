<?php

namespace Database\Seeders;

use App\Models\Move;
use App\Models\Pokemon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovePokemonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pokemonIds = Pokemon::select('id')
            ->inRandomOrder()
            ->pluck('id');

        $moveIds = Move::select('id')
            ->inRandomOrder()
            ->pluck('id')
            ->all();

        DB::table('move_pokemon')
            ->insertOrIgnore(
                $pokemonIds->map(function (int $id) use (&$moveIds) {
                    return [
                        'move_id' => $moveIds[array_rand($moveIds)],
                        'pokemon_id' => $id,
                    ];
                })->all()
            );
    }
}
