<?php

namespace App\Contract;

use App\Exception\DecisionException;
use App\ValueObject\Decision;
use App\ValueObject\FlightInformation;

interface DecisionTableInterface
{
    /**
     * Makes a decision based on the provided flight information
     *
     * @param FlightInformation $flightInfo
     * @return Decision
     * @throws DecisionException
     */
    public function makeDecision(FlightInformation $flightInfo): Decision;
}