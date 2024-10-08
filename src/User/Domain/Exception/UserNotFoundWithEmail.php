<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\User\Domain\Exception;

use App\Common\Domain\ValueObject\Email;

final class UserNotFoundWithEmail extends UserNotFound
{
    public function __construct(Email $email)
    {
        parent::__construct(sprintf('User not found with email "%s".', (string) $email));
    }
}
