<?php

namespace App\Models;

use Money\Money;
use Money\Currency;
use Money\Currencies\ISOCurrencies;
use Illuminate\Database\Eloquent\Model;
use Money\Formatter\IntlMoneyFormatter;
use Money\Parser\IntlLocalizedDecimalParser;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Plan extends Model
{
    protected $guarded = [];

    protected function membershipFee(): Attribute 
    {
        return Attribute::make(
            set: fn ($value) => $this->setMembershipFee($value)
        );
    }

    private function setMembershipFee($value) {
        $currencies = new ISOCurrencies();
        $numberFormatter = new \NumberFormatter('ms_MY', \NumberFormatter::DECIMAL_SEPARATOR_SYMBOL);
        $moneyParser = new IntlLocalizedDecimalParser($numberFormatter, $currencies);

        $currency = $this->attributes['currency'];

        $money = $moneyParser->parse($value, new Currency($currency));

        return $money->getAmount();
    }

    protected function decimalMembershipFee() : Attribute 
    {
        return Attribute::make(
            get: fn () => $this->formatMoney($this->membership_fee, $this->currency, \NumberFormatter::DECIMAL_SEPARATOR_SYMBOL)
        );
    }

    protected function currencyMembershipFee(): Attribute 
    {
        return Attribute::make(
            get: fn () => $this->formatMoney($this->membership_fee, $this->currency, \NumberFormatter::CURRENCY)
        );
    }

    private function formatMoney($amount, string $currency, $format): string 
    {
        $money = new Money($amount, new Currency(($currency)));
        $currencies = new ISOCurrencies();
        $numberFormatter = new \NumberFormatter('ms_MY', $format);
        $moneyFormatter = new IntlMoneyFormatter($numberFormatter, $currencies);

        return $moneyFormatter->format($money);
    }

}
