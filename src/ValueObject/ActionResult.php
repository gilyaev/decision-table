<?php

namespace App\ValueObject;

use App\Contract\ActionResultInterface;

final class ActionResult implements ActionResultInterface
{
    private ActionRules $action;
    private bool $result;

    /**
     * @param ActionRules $action
     * @param bool|null $result
     */
    public function __construct(ActionRules $action, ?bool $result)
    {
        $this->action = $action;
        $this->result = $result;
    }

    /**
     * @inheritdoc
     */
    public function getActionName(): string
    {
        return $this->action->getName();
    }

    /**
     * @inheritdoc
     */
    public function getResult(): string
    {
        return $this->result;
    }
}