<?php

namespace Database\Seeders;

use App\Models\Pokemon;
use Illuminate\Database\Seeder;
use App\Services\PokeApi;

class PokemonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pokemonData = PokeApi::getMultiple('pokemon');

        foreach ($pokemonData as $pokemon) {
            $newPokemon[] = [
                    'generation_id' => 1,
                    'image_url' => '',
                    'name' => $pokemon['name'],
                    'hp' => $this->findStatByName($pokemon['stats'], 'hp'),
                    'attack' => $this->findStatByName($pokemon['stats'], 'attack'),
                    'defense' => $this->findStatByName($pokemon['stats'], 'defense'),
                    'speed' => $this->findStatByName($pokemon['stats'], 'speed'),
                    'special_attack' => $this->findStatByName($pokemon['stats'], 'special-attack'),
                    'special_defense' => $this->findStatByName($pokemon['stats'], 'special-defense'),
                ];
        }

        Pokemon::upsert($newPokemon, ['name', 'generation_id']);
    }

    /**
     * Deals with the nested data structure produced by the pokéapi
     */
    private function findStatByName(array $stats, string $statName): int
    {
        $desiredStat = array_filter(
            $stats,
            fn (array $stat) => $stat['stat']['name'] === $statName
        );

        return array_shift($desiredStat)['base_stat'];
    }
}
