<?php

namespace App\Contract;

interface CountriesDictionaryInterface
{
    public function isEuropeanCountry(string $code): bool;
}