<?php

namespace App\Contract;

use App\ValueObject\Decision;

interface DecisionTransformerInterface
{
    /**
     * Transforms a Decision object into another representation.
     *
     * @param Decision $decision
     * @return mixed
     */
    public function transform(Decision $decision);
}