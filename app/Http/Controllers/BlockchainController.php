<?php

namespace App\Http\Controllers;

use App\Models\Block;
use Illuminate\Http\Request;

class BlockchainController extends Controller
{
    public function index()
    {
        // Mendapatkan semua blok dengan transaksi
        $blocks = Block::with('transactions')->orderBy('created_at', 'desc')->get();

        return view('blockchain.index', compact('blocks'));
    }
}
