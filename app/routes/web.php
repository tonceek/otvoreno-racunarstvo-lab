<?php

use App\Http\Controllers\PlayerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataRefreshController;

Route::get('/', function () {
    return view('index');
});

Route::get('/data', [PlayerController::class, 'index']);

Route::get('/players/search', [PlayerController::class, 'search'])->name('players.search');

Route::get('/schema', function() {
    return response()->file(public_path('schema.json'));
});

Route::get('/profile', function () {
    if (! auth()->check()) {
        return response('You are not logged in.');
    }

    $user = auth()->user();
    $name = $user->name ?? 'User';
    $email = $user->email ?? '';

    return response("Bok {$name}! Tvoja email adresa je {$email}.");
})->middleware('auth')->name('profile');
Route::get('/refresh-data', [DataRefreshController::class, 'refresh'])->middleware('auth');
