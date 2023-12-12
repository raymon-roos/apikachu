<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use Illuminate\Http\Request;

class PokemonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Pokemon::paginate();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pokemon $pokemon)
    {
        return $pokemon;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pokemon $pokemon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pokemon $pokemon)
    {
        //
    }
}
