<?php

namespace App\Condition;

use App\Contract\CountriesDictionaryInterface;
use App\ValueObject\FlightInformation;

/**
 * The FlightFromEUCondition class encapsulates the logic for determining if a flight originates from a European Union
 * country based on the provided flight information and the countries dictionary.
 */
class FlightFromEUCondition extends ConditionAbstract
{
    private CountriesDictionaryInterface $countriesDictionary;

    public function __construct(CountriesDictionaryInterface $countriesDictionary, array $rules)
    {
        $this->countriesDictionary = $countriesDictionary;
        parent::__construct($rules);
    }

    /**
     * @inheritdoc
     */
    protected function execute(FlightInformation $flightInformation): ?bool
    {
        return $this->countriesDictionary->isEuropeanCountry($flightInformation->getCountryCode());
    }
}