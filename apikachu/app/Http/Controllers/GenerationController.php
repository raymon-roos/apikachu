<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGenerationRequest;
use App\Models\Generation;
use Illuminate\Http\Request;

class GenerationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Generation::paginate();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGenerationRequest $request)
    {
        return Generation::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(Generation $generation)
    {
        return $generation;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Generation $generation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Generation $generation)
    {
        //
    }
}
