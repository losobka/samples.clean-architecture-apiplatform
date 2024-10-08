<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\User\Domain\ValueObject;

enum UserStatus: string
{
    case PENDING_VALIDATE_EMAIL = 'pending_validate_email';
    case ACTIVE = 'active';
    case BANNED = 'banned';
    case REMOVED = 'removed';
}
