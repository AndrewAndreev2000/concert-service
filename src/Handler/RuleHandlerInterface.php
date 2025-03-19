<?php

namespace App\Handler;

use App\Entity\Rule;

interface RuleHandlerInterface
{
    public function isApplicable(Rule $rule): bool;

    public function handle(Rule $rule, RuleContext $context): ?string;
}
