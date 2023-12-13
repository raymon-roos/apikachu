<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonGeneratorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pokemon', function (Request $request) {
    $key = $request->query('key');
    $data = Cache::get($key);

    return view('pokemon', [
        'pokemon' => $data['pokemon'] ?? null,
        'image' => $data['image'] ?? null,
    ]);
});