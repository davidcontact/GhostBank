<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable = [
        'user_id', 
        'wallet_address', 
        'currency_type', 
        'balance', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sentTransactions()
    {
        return $this->hasMany(Transaction::class, 'sender_wallet_id');
    }

    public function receivedTransactions()
    {
        return $this->hasMany(Transaction::class, 'recipient_wallet_id');
    }
}
