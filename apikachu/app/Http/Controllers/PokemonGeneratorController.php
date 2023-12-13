<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGenerateRequest;
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
        $generatedPokemonResponse = $this->openAiClient
            ->generatePokemon($request->validated('name'));

        foreach ($generatedPokemonResponse->choices as $result) {
            $generatedPokemon = $result->message->toolCalls[0]->function->arguments;
        }

        $generatedPokemonArray = json_decode($generatedPokemon, true);

        if ($request->validated('image')) {
            $imageRequest = $this->generateImage($generatedPokemonArray['image_appearance']);
            $base64String = $imageRequest->data[0]->b64_json;
        }

        $key = 'pokemonData' . Str::random();

        Cache::put($key, ['pokemon' => $generatedPokemonArray, 'image' => $base64String], 300); // 5 minutes

        return redirect('/pokemon?key=' . $key);
    }

    public function generateImage($prompt)
    {
        $generatedPokemonImageResponse = $this->openAiClient->generatePokemonImage($prompt);

        return $generatedPokemonImageResponse;
    }
}
