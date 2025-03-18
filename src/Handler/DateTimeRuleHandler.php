<?php

namespace App\Handler;

use App\Entity\DateTimeRule;
use App\Entity\Rule;
use DateTime;
use DateTimeZone;

class DateTimeRuleHandler implements RuleHandlerInterface
{
    public function supports(Rule $rule): bool
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

    /**
     * Получает текущее время пользователя с учётом его часового пояса.
     */
    private function getUserTime(RuleContext $context): DateTime
    {
        // Если часовой пояс пользователя передан в контексте, используем его
        $timezone = $context->getTimezone() ?? 'UTC';

        // Получаем текущее время в часовом поясе пользователя
        return new DateTime('now', new DateTimeZone($timezone));
    }

    /**
     * Преобразует время из базы данных (UTC) в часовой пояс пользователя.
     */
    private function convertToUserTimezone(DateTime $time, string $userTimezone): DateTime
    {
        $convertedTime = clone $time;
        $convertedTime->setTimezone(new DateTimeZone($userTimezone));

        return $convertedTime;
    }
}
