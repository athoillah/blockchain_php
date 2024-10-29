<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BlockchainController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\WalletController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;

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

// Route::middleware('auth')->group(function () {
//     Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
//     Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
//     Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
// });
Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index'); // Tampilkan semua transaksi
Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.createForm'); // Form untuk membuat transaksi
Route::post('/transactions', [TransactionController::class, 'createTransaction'])->name('transactions.store'); // Simpan transaksi baru

require __DIR__ . '/auth.php';
