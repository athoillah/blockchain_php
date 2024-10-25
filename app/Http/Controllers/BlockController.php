<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Block;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class BlockController extends Controller
{
    public function createGenesisBlock()
    {
        $data = 'Genesis Block';
        $timestamp = Carbon::now();

        $genesisBlock = new Block();
        $genesisBlock->hash = $this->calculateHash($data, $timestamp, 0, '');
        $genesisBlock->previous_hash = ''; // Tidak ada blok sebelumnya
        $genesisBlock->data = $data;
        $genesisBlock->timestamp = $timestamp;
        $genesisBlock->nonce = 0;
        $genesisBlock->save();

        return response()->json($genesisBlock, 201);
    }

    private function calculateHash($data, $timestamp, $nonce, $previousHash)
    {
        return hash('sha256', $data . $timestamp . $nonce . $previousHash);
    }
}
