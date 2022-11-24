<?php

namespace App\Service;

use App\Models\Currency;

class CurrencyService
{
    public static function getUsdPrice(string $currencySign): float
    {
        return self::getCurrency($currencySign)->rate;
    }

    public static function storeExchangeRates(): void
    {
        static $rates;

        if ($rates === null) {
            $rates = json_decode(file_get_contents('https://www.cbr-xml-daily.ru/daily_json.js'));
        }

        array_walk($rates->Valute, function ($value) {
            self::save(['currencySign' => $value->CharCode, 'rate' => $value->Value]);
        });
    }

    public static function getCurrency(string $currencySign): Currency
    {
        return Currency::where('currencySign', $currencySign)->first();
    }

    public static function save(array $input): void
    {
        $currency = Currency::create($input);

        $currency->save();
    }
}
