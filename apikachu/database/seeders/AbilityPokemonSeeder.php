<?php

namespace Database\Seeders;

use App\Models\Ability;
use App\Models\Pokemon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AbilityPokemonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pokemonIds = Pokemon::select('id')
            ->inRandomOrder()
            ->pluck('id');

        $abilityIds = Ability::select('id')
            ->inRandomOrder()
            ->pluck('id')
            ->all();

        DB::table('ability_pokemon')
            ->insertOrIgnore(
                $pokemonIds->map(function (int $id) use (&$abilityIds) {
                    return [
                        'ability_id' => $abilityIds[array_rand($abilityIds)],
                        'pokemon_id' => $id,
                    ];
                })->all()
            );
    }
}
