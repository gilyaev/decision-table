<?php

namespace App\ValueObject;

/**
 *
 * The Decision class represents a decision made for a specific flight. It contains the FlightInformation object representing
 * the flight and an array of ActionResult objects representing the actions taken based on the decision.
 * It provides methods to retrieve the flight information and the actions associated with the decision.
 */
class Decision
{
    private FlightInformation $flight;

    /**
     * @var ActionResult[]
     */
    private array $actions;

    /**
     * @param FlightInformation $flight
     * @param array $actions
     */
    public function __construct(FlightInformation $flight, array $actions)
    {
        $this->flight = $flight;
        $this->actions = $actions;
    }

    /**
     * @return FlightInformation
     */
    public function getFlight(): FlightInformation
    {
        return $this->flight;
    }

    /**
     * @return ActionResult[]
     */
    public function getActions(): array
    {
        return $this->actions;
    }
}