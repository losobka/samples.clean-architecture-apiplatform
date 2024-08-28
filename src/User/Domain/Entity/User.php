<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\User\Domain\Entity;

use App\Authentication\Domain\Event\UserHasBeenLoggedIn;
use App\Authentication\Domain\Event\UserHasBeenRemoved;
use RuntimeException;
use App\Common\Domain\Entity\AggregateRoot;
use App\Common\Domain\ValueObject\DateTime;
use App\Common\Domain\ValueObject\Email;
use App\Common\Domain\ValueObject\FirstName;
use App\Common\Domain\ValueObject\LastName;
use App\User\Domain\ValueObject\UserId;

class User extends AggregateRoot
{
    private readonly UserId $id;

    private readonly DateTime $createdAt;

    private ?DateTime $removedAt = null;
    private ?DateTime $lastLoginAt = null;

    private function __construct(
        private readonly FirstName $firstName,
        private readonly LastName $lastName,
        private readonly Email $email,
    ) {
        $this->id = UserId::generate();
        $this->createdAt = DateTime::now();
    }

    public static function create(
        FirstName $firstName,
        LastName $lastName,
        Email $email,
    ): User {
        return new self(
            $firstName,
            $lastName,
            $email,
        );
    }

    public function id(): UserId
    {
        return $this->id;
    }

    public function firstName(): FirstName
    {
        return $this->firstName;
    }

    public function lastName(): LastName
    {
        return $this->lastName;
    }

    public function email(): Email
    {
        return $this->email;
    }

    public function createdAt(): DateTime
    {
        return $this->createdAt;
    }

    public function lastLoginAt(): ?DateTime
    {
        return $this->lastLoginAt;
    }

    public function isRemoved(): bool
    {
        return null !== $this->removedAt;
    }

    public function login(): void
    {
        $this->lastLoginAt = DateTime::now();

        $this->record(domainEvent: UserHasBeenLoggedIn::create(aggregateRootId: $this->id()));
    }

    public function remove(): void
    {
        $this->ensureIsNotAlreadyRemoved();

        $this->removedAt = DateTime::now();

        $this->record(domainEvent: UserHasBeenRemoved::create(aggregateRootId: $this->id()));
    }

    private function ensureIsNotAlreadyRemoved(): void
    {
        if ($this->isRemoved()) {
            throw new RuntimeException('User is already removed !');
        }
    }
}
