<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\BlockchainController;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [BlockchainController::class, 'index']);
Route::get('/genesis-block', [BlockController::class, 'createGenesisBlock']);
