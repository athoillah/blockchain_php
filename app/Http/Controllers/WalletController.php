<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    public function create()
    {
        // Membuat public key dan secret key dengan 64 karakter
        $publicKey = Str::random(64);
        $secretKey = Str::random(64);

        // Menyimpan wallet ke database terkait user yang sedang login
        $wallet = Wallet::create([
            'user_id' => Auth::id(),
            'public_key' => $publicKey,
            'secret_key' => $secretKey,
        ]);

        return redirect()->route('wallet.index')->with('success', 'Wallet created successfully!');
    }

    public function index()
    {
        // Menampilkan daftar wallet milik user yang sedang login
        $wallets = Wallet::where('user_id', Auth::id())->get();
        return view('wallet.index', compact('wallets'));
    }
}
