<?php

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
        Schema::create('pokemons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('generation_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('next_evolution_id')
                ->unique()
                ->nullable()
                ->references('id')
                ->on('pokemons')
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->string('name')
                ->unique();
            $table->mediumText('description')
                ->nullable();
            $table->string('image_url');
            $table->mediumInteger('hp');
            $table->mediumInteger('attack');
            $table->mediumInteger('defense');
            $table->mediumInteger('speed');
            $table->mediumInteger('special_attack');
            $table->mediumInteger('special_defense');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pokemons');
    }
};
