<?php

namespace App\OpenAi;

use OpenAI;

class OpenAiClient 
{
    protected $apiKey;
    protected $client;

    public function __construct()
    {
        $this->apiKey = config('services.openai.key');
        $this->client = $this->openAiClient();
    }

    public function openAiClient()
    {
        return OpenAI::client($this->apiKey);
    }
}