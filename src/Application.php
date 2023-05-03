<?php

namespace App;

use App\Condition\CancelCondition;
use App\Condition\DelayCondition;
use App\Condition\FlightFromEUCondition;
use App\Contract\DecisionTransformerInterface;
use App\Contract\FlightRepositoryInterface;
use App\ValueObject\ActionRules;

class Application
{

    private DecisionTransformerInterface $transformer;
    private FlightRepositoryInterface $flightRepository;

    /**
     * @param DecisionTransformerInterface $transformer
     * @param FlightRepositoryInterface $flightRepository
     */
    public function __construct(DecisionTransformerInterface $transformer, FlightRepositoryInterface $flightRepository)
    {
        $this->transformer = $transformer;
        $this->flightRepository = $flightRepository;
    }

    /**
     * @throws Exception\DecisionException
     */
    public function run(): void
    {
        $flights = $this->flightRepository->getAll();
        $conditions = [
            new FlightFromEUCondition(new CountriesDictionary(), [true, true, true, true, false]),
            new CancelCondition(14, [true, null, false, null, null]),
            new DelayCondition(3, [null, true, null, false, null]),
        ];
        $actions = [
            new ActionRules('Claimable', [true, true, false, false, false, true]),
        ];

        $decisionTable = new DecisionTable($conditions, $actions);
        foreach ($flights as $flight) {
            print $this->transformer->transform($decisionTable->makeDecision($flight)) . PHP_EOL;
        }
    }
}