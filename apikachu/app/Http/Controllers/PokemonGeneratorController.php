<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OpenAi\OpenAiClient;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

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

        $name = strtolower($request->input('name'));
        $image = strtolower($request->input('image'));

        $generatedPokemonResponse = $this->openAiClient->generatePokemon($name);
        
        foreach ($generatedPokemonResponse->choices as $result) {
            $generatedPokemon = $result->message->toolCalls[0]->function->arguments;
        }

        $generatedPokemonArray = json_decode($generatedPokemon, true);


        if ($image) {
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
