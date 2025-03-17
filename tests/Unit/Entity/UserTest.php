<?php

namespace App\Tests\Unit\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testProperties(): void
    {
        $user = new User();

        self::assertNull($user->getId());
        self::assertEmpty($user->getUserIdentifier());

        self::assertNull($user->getEmail());
        $user->setEmail('test@mail.ru');
        self::assertSame('test@mail.ru', $user->getEmail());

        self::assertNull($user->getPassword());
        $user->setPassword('12345678');
        self::assertSame('12345678', $user->getPassword());

        self::assertSame([], $user->getRoles());
        $user->setRoles(['USER']);
        self::assertSame(['USER'], $user->getRoles());

        self::assertSame('test@mail.ru', $user->getUserIdentifier());
    }
}
