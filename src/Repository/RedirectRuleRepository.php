<?php

namespace App\Repository;

use App\Entity\RedirectRule;
use Doctrine\ORM\EntityRepository;

class RedirectRuleRepository extends EntityRepository
{
    /**
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
