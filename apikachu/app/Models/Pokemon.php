<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    use HasFactory;

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

    public function generation()
    {
        return $this->belongsTo(Generation::class);
    }

    public function ability()
    {
        return $this->hasMany(Ability::class);
    }
    
    public function type()
    {
        return $this->hasOne(Type::class);
    }
}
