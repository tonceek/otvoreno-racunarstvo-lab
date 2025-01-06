<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IgracController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::apiResource('igraci', IgracController::class);

// Example of additional specific routes if needed
Route::get('igraci/{id}/partner', [IgracController::class, 'showPartner'])->name('igraci.partner');
Route::get('igraci/zemlja/{zemlja}', [IgracController::class, 'getByZemlja'])->name('igraci.zemlja');
Route::get('igraci/glavna-strana/{strana}', [IgracController::class, 'getByGlavnaStrana'])->name('igraci.glavna-strana');
