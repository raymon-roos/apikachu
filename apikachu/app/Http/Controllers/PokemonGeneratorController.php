<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGenerateRequest;
use App\Models\Pokemon;
use App\OpenAi\OpenAiClient;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

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

        Pokemon::create([
            'name' => $generatedPokemon['name'],
            'description' => $generatedPokemon['description'],
            'hp' => $generatedPokemon['hp'],
            'attack' => $generatedPokemon['attack'],
            'defense' => $generatedPokemon['defense'],
            'speed' => $generatedPokemon['speed'],
            'special_attack' => $generatedPokemon['special_attack'],
            'special_defense' => $generatedPokemon['special_defense'],
            'image_url' => 'todo: implement image links'
        ]);

        $key = 'pokemonData' . Str::random();

        if ($request->validated('image')) {
            $imageRequest = $this->generateImage($generatedPokemon['image_appearance']);
            $base64String = $imageRequest->data[0]->b64_json;

            Cache::put($key, ['pokemon' => $generatedPokemon, 'image' => $base64String], 300); // TODO: save just the image to storage instead of cache
            return redirect('/pokemon?key=' . $key);
        }

        Cache::put($key, ['pokemon' => $generatedPokemon], 300); // TODO: save just the image to storage instead of cache
        return redirect('/pokemon?key=' . $key);
    }

    public function generateImage($prompt)
    {
        $generatedPokemonImageResponse = $this->openAiClient->generatePokemonImage($prompt);

        return $generatedPokemonImageResponse;
    }
}
