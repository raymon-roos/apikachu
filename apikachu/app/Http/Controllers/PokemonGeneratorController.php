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

        $generatedPokemon = $this->openAiClient->generatePokemon($request->name);

        return response()->json($generatedPokemon);
    }
}
