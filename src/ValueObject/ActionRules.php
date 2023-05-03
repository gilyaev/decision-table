<?php

namespace App\ValueObject;

final class ActionRules
{
    private string $name;
    private array $results;

    /**
     * @param string $name
     * @param array $results
     */
    public function __construct(string $name, array $results)
    {
        $this->name = $name;
        $this->results = $results;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Returns the value stored in the results array at the given index.
     *
     * @param int $index
     * @return bool
     */
    public function getResult(int $index): bool
    {
        return $this->results[$index];
    }
}