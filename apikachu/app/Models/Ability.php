<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ability extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'power',
    ];

    public function pokemons(): BelongsToMany
    {
        return $this->belongsToMany(Pokemon::class);
    }
}
