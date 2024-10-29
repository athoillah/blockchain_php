<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_wallet_id',
        'receiver_wallet_id',
        'amount',
        'transaction_hash',
    ];

    /**
     * Relasi ke Wallet Pengirim
     */
    public function senderWallet()
    {
        return $this->belongsTo(Wallet::class, 'sender_wallet_id');
    }

    /**
     * Relasi ke Wallet Penerima
     */
    public function receiverWallet()
    {
        return $this->belongsTo(Wallet::class, 'receiver_wallet_id');
    }
}
