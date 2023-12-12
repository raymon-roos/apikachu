<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AbilitySeeder::class);
        $this->call(TypeSeeder::class);
        $this->call(PokemonSeeder::class);
        $this->call(AbilityPokemonSeeder::class);
        $this->call(PokemonTypeSeeder::class);
    }
}
