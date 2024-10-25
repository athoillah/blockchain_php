<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'block_id',
        'sender',
        'recipient',
        'amount',
    ];

    public function block()
    {
        return $this->belongsTo(Block::class);
    }
}