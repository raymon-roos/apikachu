<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGenerateRequest;
use App\OpenAi\OpenAiClient;

class PokemonGeneratorController extends Controller
{
    public function __construct(
        private OpenAiClient $openAiClient = new OpenAiClient()
    ) {
    }

    public function generate(StoreGenerateRequest $request)
    {
        $generatedPokemonResponse = $this->openAiClient->generatePokemon($request->validated('name'));

        if ($request->image) {
            $generatedPokemonResponse = $this->openAiClient->generatePokemon($request->name);

            foreach ($generatedPokemonResponse->choices as $result) {
                $generatedPokemon = json_decode($result->message->toolCalls[0]->function->arguments);
            }


            $image = $this->generateImage($generatedPokemon->image_appearance);
        }


        $generatedPokemonResponse = $this->openAiClient->generatePokemon($request->name);

        foreach ($generatedPokemonResponse->choices as $result) {
            $generatedPokemon = $result->message->toolCalls[0]->function->arguments;
        }

        return $generatedPokemon;
    }

    public function generateImage($prompt)
    {
        $generatedPokemonImageResponse = $this->openAiClient->generatePokemonImage($prompt);

        return $generatedPokemonImageResponse;
    }
}
