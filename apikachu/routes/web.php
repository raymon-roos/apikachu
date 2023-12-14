<?php

use App\Models\Pokemon;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

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

Route::get('/', fn () => view('welcome'));

Route::get('/pokemon/{pokemon}', function (Request $request, Pokemon $pokemon) {
    $imagePath = "public/{$pokemon->id}.png";

    return view('pokemon', [
        'pokemon' => $pokemon->toArray(),
        'imageUrl' => Storage::has($imagePath) ? Storage::url($imagePath) : null,
    ]);
})->name('viewPokemon');
