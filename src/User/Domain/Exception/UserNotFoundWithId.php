<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\User\Domain\Exception;

use App\User\Domain\ValueObject\UserId;

final class UserNotFoundWithId extends UserNotFound
{
    public function __construct(UserId $userId)
    {
        parent::__construct(sprintf('User not found with id "%s".', (string) $userId));
    }
}
