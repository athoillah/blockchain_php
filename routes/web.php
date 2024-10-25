<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BlockchainController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\WalletController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
// Halaman utama menampilkan riwayat blockchain
Route::get('/', [BlockchainController::class, 'index'])->name('home');

// Route untuk membuat Genesis Block
Route::get('/genesis-block', [BlockController::class, 'createGenesisBlock']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/wallet', [WalletController::class, 'index'])->name('wallet.index');
    Route::post('/wallet/create', [WalletController::class, 'create'])->name('wallet.create');
});


require __DIR__ . '/auth.php';
