<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePokemonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|unique:pokemons|max:255',
            'generation_id' => 'required|integer',
            'next_evolution_id' => 'nullable|unique:pokemons|integer|min:1',
            'description' => 'nullable',
            'image_url' => 'required|max:255',
            'hp' => 'required|integer|between:1,100',
            'attack' => 'required|integer|between:1,100',
            'defense' => 'required|integer|between:1,100',
            'speed' => 'required|integer|between:1,100',
            'special_attack' => 'required|integer|between:1,100',
            'special_defense' => 'required|integer|between:1,100',
        ];
    }
}
