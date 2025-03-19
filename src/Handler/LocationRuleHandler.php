<?php

namespace App\Handler;

use App\Entity\LocationRule;
use App\Entity\Rule;

class LocationRuleHandler implements RuleHandlerInterface
{
    public function isApplicable(Rule $rule): bool
    {
        return $rule instanceof LocationRule;
    }

    public function handle(Rule $rule, RuleContext $context): ?string
    {
        $redirectRule = $rule->getRedirectRule();
        $userCity = $context->getCity();
        /** @var LocationRule $rule */
        $ruleCity = $rule->getCity();

        if ($ruleCity === $userCity) {
            return $redirectRule->getRedirectUrl();
        }

        return null;
    }
}
