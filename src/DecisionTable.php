<?php

namespace App;

use App\Contract\ConditionInterface;
use App\Contract\DecisionTableInterface;
use App\Exception\DecisionException;
use App\ValueObject\Decision;
use App\ValueObject\FlightInformation;
use App\ValueObject\ActionResult;
use App\ValueObject\ActionRules;


/**
 * The DecisionTable class implements the DecisionTableInterface and is responsible for making decisions
 * based on a set of conditions and actions. It takes an array of conditions and an array of action rules as inputs.
 */
class DecisionTable implements DecisionTableInterface
{
    /**
     * @var ConditionInterface[]
     */
    private array $conditions;

    /**
     * @var ActionRules[]
     */
    private array $actions;

    /**
     * @param array $conditions
     * @param ActionRules[] $actions
     */
    public function __construct(array $conditions, array $actions)
    {
        $this->conditions = $conditions;
        $this->actions = $actions;
    }

    /**
     * @inheritdoc
     */
    public function makeDecision(FlightInformation $flightInfo): Decision
    {
        $lastRules = [];
        /** @var ConditionInterface $condition */
        foreach ($this->conditions as $condition) {
            $lastRules = $condition->makeDecision($flightInfo, $lastRules);
        }

        if (count($lastRules) !== 1) {
            throw new DecisionException('Unable to make a decision.');
        }

        $resultIndex = array_key_first($lastRules);

        $actionsResult = array_map(
            static fn(ActionRules $action) => new ActionResult($action, $action->getResult($resultIndex)),
            $this->actions
        );

        return new Decision(
            $flightInfo,
            $actionsResult
        );
    }
}