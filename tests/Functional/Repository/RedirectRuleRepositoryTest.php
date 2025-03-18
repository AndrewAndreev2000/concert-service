<?php

namespace App\Tests\Functional\Repository;

use App\Entity\RedirectRule;
use App\Repository\RedirectRuleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class RedirectRuleRepositoryTest extends TestCase
{
    private EntityManagerInterface&MockObject $em;
    private RedirectRuleRepository $repository;

    protected function setUp(): void
    {
        $this->em = self::createMock(EntityManagerInterface::class);
        $classMetadata = self::createMock(ClassMetadata::class);
        $classMetadata->name = RedirectRule::class;

        $this->repository = new RedirectRuleRepository(
            $this->em,
            $classMetadata,
        );
    }

    public function testFindByConcertSlug(): void
    {
        $concertSlug = 'test-concert';
        $expectedResult = [new RedirectRule(), new RedirectRule()];

        $qb = self::createMock(QueryBuilder::class);
        $query = self::createMock(Query::class);

        $this->em->expects(self::once())
            ->method('createQueryBuilder')
            ->willReturn($qb);

        $qb->expects(self::once())
            ->method('select')
            ->with('redirect_rule')
            ->willReturnSelf();
        $qb->expects(self::once())
            ->method('from')
            ->with(RedirectRule::class, 'redirect_rule', null)
            ->willReturnSelf();
        $qb->expects(self::once())
            ->method('join')
            ->with('redirect_rule.concert', 'concert')
            ->willReturnSelf();
        $qb->expects(self::once())
            ->method('andWhere')
            ->with('concert.slug = :slug')
            ->willReturnSelf();
        $qb->expects(self::once())
            ->method('setParameter')
            ->with('slug', $concertSlug)
            ->willReturnSelf();
        $qb->expects(self::once())
            ->method('getQuery')
            ->willReturn($query);

        $query->expects(self::once())
            ->method('getResult')
            ->willReturn($expectedResult);

        $result = $this->repository->findByConcertSlug($concertSlug);

        self::assertEquals($expectedResult, $result);
    }

    public function testFindByConcertSlugReturnsEmptyArrayWhenNoResults(): void
    {
        $concertSlug = 'non-existent-concert';

        $qb = self::createMock(QueryBuilder::class);

        $query = self::createMock(Query::class);

        $this->em->expects(self::once())
            ->method('createQueryBuilder')
            ->willReturn($qb);

        $qb->expects(self::once())
            ->method('select')
            ->with('redirect_rule')
            ->willReturnSelf();
        $qb->expects(self::once())
            ->method('from')
            ->with(RedirectRule::class, 'redirect_rule', null)
            ->willReturnSelf();
        $qb->expects(self::once())
            ->method('join')
            ->with('redirect_rule.concert', 'concert')
            ->willReturnSelf();
        $qb->expects(self::once())
            ->method('andWhere')
            ->with('concert.slug = :slug')
            ->willReturnSelf();
        $qb->expects(self::once())
            ->method('setParameter')
            ->with('slug', $concertSlug)
            ->willReturnSelf();
        $qb->expects(self::once())
            ->method('getQuery')
            ->willReturn($query);

        $query->expects(self::once())
            ->method('getResult')
            ->willReturn([]);

        $result = $this->repository->findByConcertSlug($concertSlug);

        self::assertIsArray($result);
        self::assertEmpty($result);
    }
}
