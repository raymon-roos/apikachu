<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GeneratePokemonWithOpenAiTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_response_generating_random_pokemon(): void
    {
            $response = $this->post('/api/generate', [
            'name' => 'Create a valid JSON array of these types: bigint generation_id, string name, string description, int hp, int attack, int defense, of some random pokemon a user would want you to generate'
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'generation_id',
            'name',
            'description',
            'hp',
            'attack',
            'defense'
        ]);
    }
}
