<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Authentication\Domain\Event;

use Override;
use App\Common\Domain\Event\DomainEvent;

final class UserHasBeenRegistered extends DomainEvent
{
    public const string EVENT_NAME = 'authentication.user_has_been_registered';

    #[Override]
    public static function eventName(): string
    {
        return self::EVENT_NAME;
    }
}
