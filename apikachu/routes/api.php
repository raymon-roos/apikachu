<?php

use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonGeneratorController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')
    ->get('/user', fn (Request $request) => $request->user());

Route::post('/generate', [Controllers\PokemonGeneratorController::class, 'generate']);

Route::resources([
    'pokemon' => Controllers\PokemonController::class,
    'type' => Controllers\TypeController::class,
    'ability' => Controllers\AbilityController::class,
    'generation' => Controllers\GenerationController::class,
]);
