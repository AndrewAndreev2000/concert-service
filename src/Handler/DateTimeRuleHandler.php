<?php

namespace App\Handler;

use App\Entity\DateTimeRule;
use App\Entity\Rule;
use DateTime;
use DateTimeZone;

class DateTimeRuleHandler implements RuleHandlerInterface
{
    public function isApplicable(Rule $rule): bool
    {
        return $rule instanceof DateTimeRule;
    }

    public function handle(Rule $rule, RuleContext $context): ?string
    {
        /** @var DateTimeRule $dateTimeRule */
        $dateTimeRule = $rule;
        $userTime = $this->getUserTime($context);
        $startDateTime = $this->convertToUserTimezone($dateTimeRule->getStartDateTime(), $context->getTimezone());
        $endDateTime = $this->convertToUserTimezone($dateTimeRule->getEndDateTime(), $context->getTimezone());

        if ($userTime >= $startDateTime && $userTime <= $endDateTime) {
            return $dateTimeRule->getRedirectRule()->getRedirectUrl();
        }

        return null;
    }

    private function getUserTime(RuleContext $context): DateTime
    {
        $timezone = $context->getTimezone() ?? 'UTC';

        return new DateTime('now', new DateTimeZone($timezone));
    }

    private function convertToUserTimezone(DateTime $time, string $userTimezone): DateTime
    {
        $convertedTime = clone $time;
        $convertedTime->setTimezone(new DateTimeZone($userTimezone));

        return $convertedTime;
    }
}
