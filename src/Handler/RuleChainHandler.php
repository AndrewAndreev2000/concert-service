<?php

namespace App\Handler;

use App\Entity\RedirectRule;

class RuleChainHandler
{
    /**
     * @param iterable<RuleHandlerInterface> $handlers
     */
    public function __construct(
        private iterable $handlers,
    ) {
    }

    public function process(RedirectRule $redirectRule, RuleContext $context): ?string
    {
        foreach ($redirectRule->getRules() as $rule) {
            $ruleSatisfied = false;

            foreach ($this->handlers as $handler) {
                if ($handler->isApplicable($rule)) {
                    $result = $handler->handle($rule, $context);

                    if ($result) {
                        $ruleSatisfied = true;
                        break;
                    }
                }
            }

            if (!$ruleSatisfied) {
                return null;
            }
        }

        return $redirectRule->getRedirectUrl();
    }
}
