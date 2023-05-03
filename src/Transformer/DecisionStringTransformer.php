<?php

namespace App\Transformer;

use App\Contract\DecisionTransformerInterface;
use App\ValueObject\Decision;

/**
 * The DecisionStringTransformer class implements the DecisionTransformerInterface and
 * provides a method to transform a Decision object into a string representation.
 *
 * LV Cancel 20 N
 */
class DecisionStringTransformer implements DecisionTransformerInterface
{
    /**
     * @inheritdoc
     */
    public function transform(Decision $decision): string
    {
        $result = [];
        foreach ($decision->getActions() as $action) {
            $result[] = implode(
                ' ',
                $decision->getFlight()->toArray() + [$action->getResult() ? 'Y' : 'N']
            );
        }
        return implode(PHP_EOL, $result);
    }
}