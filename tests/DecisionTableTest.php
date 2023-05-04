<?php

namespace Test;

use App\Condition\CancelCondition;
use App\Condition\DelayCondition;
use App\Condition\FlightFromEUCondition;
use App\CountriesDictionary;
use App\DecisionTable;
use App\ValueObject\ActionRules;
use App\ValueObject\FlightInformation;
use PHPUnit\Framework\TestCase;

class DecisionTableTest extends TestCase
{
    public function flightsDataProvider(): array
    {
        return [
            'testcase#1' => [
                'flight' => FlightInformation::fromArray([
                    'countryCode' => 'LV',
                    'status' => FlightInformation::STATUS_CANCEL,
                    'statusDetail' => 20,
                ]),
                'expectedResult' => false
            ],

            'testcase#2' => [
                'flight' => FlightInformation::fromArray([
                    'countryCode' => 'RU',
                    'status' => FlightInformation::STATUS_CANCEL,
                    'statusDetail' => 10,
                ]),
                'expectedResult' => false
            ],

            'testcase#3' => [
                'flight' => FlightInformation::fromArray([
                    'countryCode' => 'LT',
                    'status' => FlightInformation::STATUS_DELAY,
                    'statusDetail' => 1,
                ]),
                'expectedResult' => false
            ],

            'testcase#4' => [
                'flight' => FlightInformation::fromArray([
                    'countryCode' => 'LT',
                    'status' => FlightInformation::STATUS_DELAY,
                    'statusDetail' => 3,
                ]),
                'expectedResult' => true
            ],

            'testcase#5' => [
                'flight' => FlightInformation::fromArray([
                    'countryCode' => 'LV',
                    'status' => FlightInformation::STATUS_DELAY,
                    'statusDetail' => 4,
                ]),
                'expectedResult' => true
            ],

            'testcase#6' => [
                'flight' => FlightInformation::fromArray([
                    'countryCode' => 'LT',
                    'status' => FlightInformation::STATUS_CANCEL,
                    'statusDetail' => 1,
                ]),
                'expectedResult' => true
            ],
        ];
    }

    /**
     * @dataProvider flightsDataProvider
     */
    public function testDecisionTable(FlightInformation $flight, bool $expectedResult): void
    {
        $conditions = [
            new FlightFromEUCondition(new CountriesDictionary(), [true, true, true, true, false]),
            new CancelCondition(14, [true, null, false, null, null]),
            new DelayCondition(3, [null, true, null, false, null]),
        ];
        $actions = [
            new ActionRules('Claimable', [true, true, false, false, false, true])
        ];

        $decisionTable = new DecisionTable($conditions, $actions);
        $decision = $decisionTable->makeDecision($flight);

        foreach ($decision->getActions() as $action) {
            $this->assertEquals($expectedResult, $action->getResult());
        }
    }
}