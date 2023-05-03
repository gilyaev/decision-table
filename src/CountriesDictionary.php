<?php

namespace App;

use App\Contract\CountriesDictionaryInterface;

/**
 * The CountriesDictionary class implements the CountriesDictionaryInterface and determines
 * if a country is in the European Union based on its country code.
 */
class CountriesDictionary implements CountriesDictionaryInterface
{
    protected const COUNTRIES = [
        'LV' => ['isEU' => true],
        'LT' => ['isEU' => true],
        'RU' => ['isEU' => false],
    ];

    public function isEuropeanCountry(string $code): bool
    {
        return isset(self::COUNTRIES[$code]) && self::COUNTRIES[$code]['isEU'];
    }
}