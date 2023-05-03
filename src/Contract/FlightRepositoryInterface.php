<?php

namespace App\Contract;

use App\ValueObject\FlightInformation;

interface FlightRepositoryInterface
{
    /**
     * Returns an array of FlightInformation objects representing all flights
     * @return FlightInformation[]
     */
    public function getAll(): array;
}