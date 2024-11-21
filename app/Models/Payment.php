<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded = [];

    public const SUPPORTED_GATEWAY = [
        'securepay'
    ];

    public const PAYMENT_METHODS = [
        'cash' => 'Cash',
        'duitnowqr' => 'Duitnow QR',
        'creditcard' => 'Credit Card',
        'banktransfer' => 'Bank Transfer'
    ];
}
