<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wallet extends Model
{
    use HasFactory;

    // Field yang dapat diisi
    protected $fillable = [
        'user_id',
        'public_key',
        'secret_key',
    ];
    /**
     * Relasi dengan model User
     * Wallet berelasi dengan satu pengguna
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
