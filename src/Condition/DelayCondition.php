<?php

namespace App\Condition;

use App\ValueObject\FlightInformation;

/**
 * The DelayCondition class encapsulates the logic for determining if a flight delay condition is met
 * based on the provided flight information and the specified number of days.
 */
class DelayCondition extends ConditionAbstract
{
    private int $days;

    public function __construct(int $days, array $rules)
    {
        $this->days = $days;
        parent::__construct($rules);
    }

    /**
     * @inheritdoc
     */
    protected function execute(FlightInformation $flightInformation): ?bool
    {
        if(!$flightInformation->isDelay() ) {
            return null;
        }
        return $flightInformation->getStatusDetail() >= $this->days ;
    }
}