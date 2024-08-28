<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Authentication\Domain\Entity;

use App\Authentication\Domain\Event\UserPasswordHasBeenChanged;
use App\Authentication\Domain\Exception\NewPasswordShouldBeDifferentOfCurrentPassword;
use App\Authentication\Domain\ValueObject\HashedPassword;
use App\Authentication\Domain\ValueObject\Username;
use App\User\Domain\Entity\User;
use App\User\Domain\ValueObject\UserId;

class UserCredential
{
    private readonly UserId $id;

    private function __construct(
//        private readonly UserId $id,
        private readonly User $user,
//        private readonly UserId $user,
        private Username $username,
        private HashedPassword $hashedPassword,
    ) {
        $this->id = UserId::generate();
    }

    public static function create(
//        UserId $id,
        User $user,
        Username $username,
        HashedPassword $hashedPassword,
    ): UserCredential {
        return new self($user,$username, $hashedPassword);
    }

    public function id(): UserId
    {
        return $this->id;
    }

    public function user(): User
    {
        return $this->user;
    }

    public function username(): Username
    {
        return $this->username;
    }

    public function hashedPassword(): HashedPassword
    {
        return $this->hashedPassword;
    }

    public function changeUsername(Username $username): void
    {
        $this->username = $username;
    }

    /**
     * @throws NewPasswordShouldBeDifferentOfCurrentPassword
     */
    public function changePassword(HashedPassword $hashedPassword): void
    {
        if ($this->hashedPassword()->isEqual($hashedPassword)) {
            throw new NewPasswordShouldBeDifferentOfCurrentPassword();
        }

        $this->hashedPassword = $hashedPassword;

        $this->user()->record(domainEvent: UserPasswordHasBeenChanged::create(aggregateRootId: $this->user()->id()));
    }
}
