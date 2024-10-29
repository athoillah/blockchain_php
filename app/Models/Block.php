<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Block extends Model
{
    use HasFactory;

    protected $fillable = [
        'hash',
        'previous_hash',
        'data',
        'timestamp',
        'nonce',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'block_id');
        // return $this->hasMany(Transaction::class);
    }
}
