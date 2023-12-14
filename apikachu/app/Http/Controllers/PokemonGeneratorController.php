<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGenerateRequest;
use App\Models\Pokemon;
use App\OpenAi\OpenAiClient;
use Illuminate\Support\Facades\Storage;

class PokemonGeneratorController extends Controller
{
    public function __construct(
        private OpenAiClient $openAiClient = new OpenAiClient()
    ) {
    }

    public function generate(StoreGenerateRequest $request)
    {
        $generatedPokemon = $this->openAiClient
            ->generatePokemon($request->validated('name'));

        $pokemon = Pokemon::whereName($generatedPokemon['name'])
            ->firstOrCreate(values: [
                'name' => $generatedPokemon['name'],
                'description' => $generatedPokemon['description'],
                'hp' => $generatedPokemon['hp'],
                'attack' => $generatedPokemon['attack'],
                'defense' => $generatedPokemon['defense'],
                'speed' => $generatedPokemon['speed'],
                'special_attack' => $generatedPokemon['special_attack'],
                'special_defense' => $generatedPokemon['special_defense'],
                'image_url' => 'x'
            ]);

        if ($request->validated('image')) {
            $base64String = $this->generateImage($generatedPokemon['image_appearance']);

            Storage::put("public/{$pokemon->id}.png", base64_decode($base64String));
        }

        return to_route('viewPokemon', [$pokemon]);
    }

    private function generateImage($prompt)
    {
        $generatedPokemonImageResponse = $this->openAiClient->generatePokemonImage($prompt);

        return $generatedPokemonImageResponse->data[0]->b64_json;
    }
}
