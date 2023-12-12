<?php

namespace App\OpenAi;

use OpenAI;
use Illuminate\Support\Facades\Log;

class OpenAiClient 
{
    protected $apiKey;
    protected $openAi;

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

    public function generatePokemon($name)
    {
        $generatedPokemon = $this->openAi->chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'system', 'content' => 'Create a valid JSON response of some random pokemon a user would want you to generate'],   
                ['role' => 'user', 'content' => $name],
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
                                'description' => 'pokemon hp',
                            ],
                            'attack' => [
                                'type' => 'integer',
                                'description' => 'pokemon attack',
                            ],
                            'defense' => [
                                'type' => 'integer',
                                'description' => 'pokemon defense',
                            ],
                            'generation_id' => [
                                'type' => 'integer',
                                'description' => 'pokemon generation id, at the moment 10 because we are in generation 10',
                            ],
                        ],
                            'required' => ['name', 'description', 'hp', 'attack', 'defense', 'generation_id'],
                        ],
                    ],
                ],
            ],
            'max_tokens' => 255,
            'temperature' => 0.9,
        ]);

        return $generatedPokemon;
    }   
}