<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Wallet;
use App\Models\Block;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    // Tampilkan semua transaksi untuk wallet pengguna yang sedang login
    public function index()
    {
        $wallet = Wallet::where('user_id', Auth::id())->first();

        if (!$wallet) {
            return redirect()->back()->with('error', 'Wallet not found');
        }

        $transactions = Transaction::where('sender', $wallet->public_key)
            ->orWhere('recipient', $wallet->public_key)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('transactions.index', compact('transactions'));
    }

    // Tampilkan form untuk membuat transaksi
    public function create()
    {
        return view('transactions.create'); // Pastikan ada view transactions/create.blade.php
    }

    // Simpan transaksi baru
    public function createTransaction(Request $request)
    {
        $request->validate([
            'recipient' => 'required|exists:wallets,public_key',
            'amount' => 'required|numeric|min:0.01',
        ]);

        $senderWallet = Wallet::where('user_id', Auth::id())->first();
        if (!$senderWallet) {
            return redirect()->back()->with('error', 'Wallet not found');
        }

        $recipientWallet = Wallet::where('public_key', $request->recipient)->first();

        if ($senderWallet->balance < $request->amount) {
            return redirect()->back()->with('error', 'Insufficient balance');
        }

        // Buat transaksi baru
        $lastBlock = Block::latest()->first();

        $transaction = new Transaction();
        $transaction->sender = $senderWallet->public_key;
        $transaction->recipient = $recipientWallet->public_key;
        $transaction->amount = $request->amount;
        $transaction->block_id = $lastBlock ? $lastBlock->id : null; // Pastikan block_id diisi dengan blok terakhir atau NULL
        $transaction->save();

        // Update saldo pengirim dan penerima
        $senderWallet->balance -= $request->amount;
        $senderWallet->save();

        $recipientWallet->balance += $request->amount;
        $recipientWallet->save();

        return redirect()->route('transactions.index')->with('success', 'Transaction successful!');
    }
}
