<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pokemon extends Model
{
    use HasFactory;

    /**
     * The table associated with the model, eloquent can't guess the plural of "pokemon".
     *
     * @var string
     */
    protected $table = 'pokemons';

    protected $fillable = [
        'generation_id',
        'next_evolution_id',
        'name',
        'description',
        'image_url',
        'hp',
        'attack',
        'defense',
        'speed',
        'special_attack',
        'special_defense',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function generation()
    {
        return $this->belongsTo(Generation::class);
    }

    public function abilities(): BelongsToMany
    {
        return $this->belongsToMany(Ability::class);
    }

    public function types(): BelongsToMany
    {
        return $this->belongsToMany(Type::class);
    }
}
