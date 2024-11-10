<?php

use App\Http\Controllers\PlayerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/data', [PlayerController::class, 'index']);

Route::get('/players/search', [PlayerController::class, 'search'])->name('players.search');

Route::get('/schema', function() {
    return response()->file(public_path('schema.json'));
});
