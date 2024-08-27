<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Authentication\Domain\Event;

use App\Common\Domain\Event\DomainEvent;

final class UserPasswordHasBeenChanged extends DomainEvent
{
    public const EVENT_NAME = 'authentication.user_password_has_been_changed';

    public static function eventName(): string
    {
        return self::EVENT_NAME;
    }
}
