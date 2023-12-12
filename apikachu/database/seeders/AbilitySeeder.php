<?php

namespace Database\Seeders;

use App\Models\Ability;
use App\Services\PokeApi;
use Illuminate\Database\Seeder;

class AbilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $abilityData = PokeApi::getMultiple('ability');

        foreach ($abilityData as $ability) {
            $newAbilities[] = [
                'name' => $ability['name'],
                'description' => $this->findEnglishFlavourText($ability['flavor_text_entries']),
                'power' => random_int(1, 100),
            ];
        }

        Ability::upsert($newAbilities, 'name');
    }

    /**
     * Deals with the nested data structure produced by the pokéapi
     */
    private function findEnglishFlavourText(array $flavourTexts): string
    {
        $texts = array_filter(
            $flavourTexts,
            fn (array $text) => $text['language']['name'] === 'en'
        );

        return array_shift($texts)['flavor_text'];
    }
}
