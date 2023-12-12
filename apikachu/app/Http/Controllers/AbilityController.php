<?php

namespace App\Http\Controllers;

use App\Models\Ability;
use Illuminate\Http\Request;

class AbilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Ability::paginate();
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
    public function show(Ability $ability)
    {
        return $ability;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ability $ability)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ability $ability)
    {
        //
    }
}
