<?php

namespace App\Models;

use Money\Currency;
use Money\Currencies\ISOCurrencies;
use Illuminate\Database\Eloquent\Model;
use Money\Parser\IntlLocalizedDecimalParser;
use Illuminate\Database\Eloquent\Casts\Attribute;

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

    protected function amount(): Attribute 
    {
        return Attribute::make(
            // set: fn ($value) => $value * 100,
            get: fn ($value) => $value / 100
        );
    }
}
