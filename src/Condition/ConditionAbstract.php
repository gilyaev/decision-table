<?php

namespace App\Condition;

use App\Contract\ConditionInterface;
use App\ValueObject\FlightInformation;

abstract class ConditionAbstract implements ConditionInterface
{
    protected array $rules = [];

    /**
     * @param array $rules
     */
    public function __construct(array $rules)
    {
        $this->rules = $rules;
    }

    /**
     * @inheritdoc
     */
    public function makeDecision(FlightInformation $flightInfo, array $previousRules = []): array
    {
        $conditionStatus = $this->execute($flightInfo);
        if ($conditionStatus === null || count($previousRules) === 1) {
            return $previousRules;
        }

        if (empty($previousRules)) {
            return array_filter($this->rules, static fn (?bool $status) => $status === $conditionStatus);
        }

        $rules = [];
        foreach ($previousRules as $key => $value) {
            if ($this->rules[$key] === $conditionStatus) {
                $rules[$key] = $value;
            }
        }

        return  $rules;
    }

    /**
     * Executes condition
     *
     * @param FlightInformation $flightInformation
     * @return bool|null Returns null if the condition is not applicable in the given context.
     * If the condition is applicable, the method returns true if the condition is met,
     * and false if the condition is not met.
     */
    abstract protected function execute(FlightInformation $flightInformation): ?bool;
}