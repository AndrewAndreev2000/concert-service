<?php

namespace App\Repository;

use App\Entity\RedirectRule;
use Doctrine\ORM\EntityRepository;

class RedirectRuleRepository extends EntityRepository
{
    /**
     * Находит правила редиректа для конкретного концерта по его slug.
     *
     * @param string $concertSlug
     * @return RedirectRule[]
     */
    public function findByConcertSlug(string $concertSlug): array
    {
        $qb = $this->createQueryBuilder('redirect_rule')
            ->join('redirect_rule.concert', 'concert')
            ->andWhere('concert.slug = :slug')
            ->setParameter('slug', $concertSlug);

        return $qb->getQuery()->getResult() ?? [];
    }
}
