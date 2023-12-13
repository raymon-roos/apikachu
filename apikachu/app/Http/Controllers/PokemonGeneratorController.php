<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGenerateRequest;
use App\OpenAi\OpenAiClient;

class PokemonGeneratorController extends Controller
{
    protected OpenAiClient $openAiClient;

    public function __construct(OpenAiClient $openAiClient)
    {
        $this->openAiClient = $openAiClient;
    }

    public function generate(StoreGenerateRequest $request)
    {
        $generatedPokemonResponse = $this->openAiClient->generatePokemon($request->validated('name'));

        foreach ($generatedPokemonResponse->choices as $result) {
            $generatedPokemon = $result->message->toolCalls[0]->function->arguments;
        }

        return $generatedPokemon;
    }
}
