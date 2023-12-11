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
        $generatedPokemon = $this->openAi->completions()->create([
            'model' => 'gpt-3.5-turbo-instruct',
            'prompt' => 'Make a pokemon with this user input string: ' . $name . '',
            'max_tokens' => 255,
            'temperature' => 0.5
        ]);

        return $generatedPokemon->choices[0]->text;
    }   
}