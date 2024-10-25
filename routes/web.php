<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlockController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/genesis-block', [BlockController::class, 'createGenesisBlock']);
