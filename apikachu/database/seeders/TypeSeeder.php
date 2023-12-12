<?php

namespace Database\Seeders;

use App\Models\Type;
use App\Services\PokeApi;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Type::upsert(array_map(
            fn (string $type) => ['name' => $type],
            array_column(PokeApi::getMultiple('type'), 'name')
        ), 'name');
    }
}
