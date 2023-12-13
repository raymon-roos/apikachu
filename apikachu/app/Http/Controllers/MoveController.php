<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMoveRequest;
use App\Models\Move;
use Illuminate\Support\Facades\Request;

class MoveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Move::paginate();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMoveRequest $request)
    {
        return Move::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(Move $move)
    {
        return $move;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Move $move)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Move $move)
    {
        //
    }
}
