<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OpenAi\OpenAiClient;

class PokemonGeneratorController extends Controller
{
    protected OpenAiClient $openAiClient;

    public function __construct(OpenAiClient $openAiClient) 
    {
        $this->openAiClient = $openAiClient;
    }

    public function generate(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $generatedPokemon = $this->openAiClient->openAiClient()->completions()->create([
            'model' => 'gpt-3.5-turbo-instruct',
            'prompt' => 'Make a pokemon with this user input string: ' . $request->name . '',
            'max_tokens' => 255,
            'temperature' => 0
        ]);

        return response()->json($generatedPokemon);
    }
}
