<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    // Allow these fields to be mass-assigned
    protected $fillable = [
        'sender_wallet_id',
        'recipient_wallet_id',
        'amount',
        'currency_type',
        'type',
        'status',
        'description',
        'transaction_hash',
        'fee',
    ];
}
