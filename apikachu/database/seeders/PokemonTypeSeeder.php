<?php

namespace Database\Seeders;

use App\Models\Pokemon;
use App\Models\Type;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PokemonTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pokemonIds = Pokemon::select('id')
            ->inRandomOrder()
            ->pluck('id');

        $typeIds = Type::select('id')
            ->inRandomOrder()
            ->pluck('id')
            ->all();

        DB::table('pokemon_type')
            ->insertOrIgnore(
                $pokemonIds->map(function (int $id) use (&$typeIds) {
                    return [
                        'type_id' => $typeIds[array_rand($typeIds)],
                        'pokemon_id' => $id,
                    ];
                })->all()
            );
    }
}
