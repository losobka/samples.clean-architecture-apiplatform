<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Authentication\Domain\Event;

use App\Common\Domain\Event\DomainEvent;

final class UserHasBeenRemoved extends DomainEvent
{
    public const EVENT_NAME = 'user.user_has_been_removed';

    public static function eventName(): string
    {
        return self::EVENT_NAME;
    }
}
