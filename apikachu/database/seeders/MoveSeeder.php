<?php

namespace Database\Seeders;

use App\Models\Move;
use App\Services\PokeApi;
use Illuminate\Database\Seeder;

class MoveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $newMoves = array_map(fn (array $move) => [
            'name' => $move['name'],
            'description' => $this->findEnglishFlavourText($move['flavor_text_entries']),
            'power' => $move['power'] ?? 0,
        ], PokeApi::getMultiple('move'));

        Move::upsert($newMoves, 'name');
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
