<?php

use Database\Seeders\DatabaseSeeder;
use Database\Seeders\GenerationSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('generations', function (Blueprint $table) {
            $table->id();
            $table->mediumInteger('generation')
                ->unique();
            $table->timestamps();
        });

        (new DatabaseSeeder())->call(GenerationSeeder::class);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('generations');
    }
};
