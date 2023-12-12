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
            'image' => 'required|boolean',
        ]);

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
