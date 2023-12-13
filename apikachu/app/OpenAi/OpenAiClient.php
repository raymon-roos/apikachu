<?php

namespace App\OpenAi;

use OpenAI;
use Illuminate\Support\Facades\Log;

class OpenAiClient
{
    private $apiKey;
    private $openAi;

    public function __construct()
    {
        $this->apiKey = config('services.openai.key');
        $this->openAi = $this->openAiClient();
    }

    protected function openAiClient()
    {
        try {
            $response = OpenAI::client($this->apiKey);
        } catch (\Exception $e) {
            Log::error('OpenAI client error: ' . $e->getMessage());
        }

        return $response;
    }

    public function generatePokemonImage($prompt)
    {
        $generatedPokemonImage = $this->openAi->images()->create([
            'model' => 'dall-e-3',
            'prompt' => $prompt,
            'response_format' => 'b64_json',
            'size' => '1024x1024',
        ]);

        return $generatedPokemonImage;
    }

    public function generatePokemon(string $prompt)
    {
        $generatedPokemonResponse = $this->createPokemonChat($prompt);

        foreach ($generatedPokemonResponse->choices as $result) {
            $generatedPokemon = $result->message->toolCalls[0]->function->arguments;
        }

        return json_decode($generatedPokemon, true);
    }

    private function createPokemonChat(string $prompt)
    {
        return $this->openAi->chat()->create([
            'model' => 'gpt-3.5-turbo-1106',
            'messages' => [
                ['role' => 'system', 'content' => 'Create a new Pokemon character based on the input of the user with the following unique attributes: - Name - Short description less than 80 characters - The type of Pokemon - Number of Hit Points or health - Number of attack damage - Number of defense - Number of speed - Number of special attack - Number of special defense - The Pokémon’s abilities - The Pokémon’s moves - The Pokemons evolutions and the level at which this evolution is reached - The Pokemon\'s appearance in less than 600 characters  Format the response in a valid JSON object'],
                ['role' => 'user', 'content' => $prompt],
            ],
            'tools' => [
                [
                'type' => 'function',
                'function' => [
                    'name' => 'pokemon_generator',
                    'description' => 'Generate a random pokemon with the given name or description',
                    'parameters' => [
                        'type' => 'object',
                        'properties' => [
                            'name' => [
                                'type' => 'string',
                                'description' => 'pokemon name',
                            ],
                            'description' => [
                                'type' => 'string',
                                'description' => 'pokemon description',
                            ],
                            'hp' => [
                                'type' => 'integer',
                                'description' => 'pokemon hp, between 0 and 100',
                            ],
                            'attack' => [
                                'type' => 'integer',
                                'description' => 'pokemon attack, between 0 and 100',
                            ],
                            'defense' => [
                                'type' => 'integer',
                                'description' => 'pokemon defense, between 0 and 100',
                            ],
                            'speed' => [
                                'type' => 'integer',
                                'description' => 'pokemon speed, between 0 and 100',
                            ],
                            'special_attack' => [
                                'type' => 'integer',
                                'description' => 'pokemon special attack, between 0 and 100',
                            ],
                            'special_defense' => [
                                'type' => 'integer',
                                'description' => 'pokemon special defense, between 0 and 100',
                            ],
                            'generation_id' => [
                                'type' => 'integer',
                                'description' => 'pokemon generation id, at the moment 10 because we are in generation 10',
                            ],
                            'image_appearance' => [
                                'type' => 'string',
                                'description' => 'pokemon appearance for ai image prompt',
                            ],
                        ],
                            'required' => ['name', 'description', 'hp', 'attack', 'defense', 'generation_id', 'image_appearance'],
                        ],
                    ],
                ],
            ],
            // 'max_tokens' => 255,
            // 'temperature' => 0.9,
        ]);
    }
}
