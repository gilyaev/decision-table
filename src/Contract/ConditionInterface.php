<?php

namespace App\Contract;

use App\ValueObject\FlightInformation;

interface ConditionInterface
{
    /**
     * This method makes a decision based on flight information and previous rules.
     *
     * @param FlightInformation $flightInfo
     * @param array $previousRules
     * @return array Returns an array of rules that are applicable for the given condition
     */
    public function makeDecision(FlightInformation $flightInfo, array $previousRules = []): array;
}