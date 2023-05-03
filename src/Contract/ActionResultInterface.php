<?php

namespace App\Contract;

interface ActionResultInterface
{
    /**
     * Returns a string representing the name of the action.
     * @return string
     */
    public function getActionName(): string;

    /**
     * Returns a string representing the result of the action.
     * @return string
     */
    public function getResult(): string;
}